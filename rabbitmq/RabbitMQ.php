<?php

/**
 * 消息队列
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * Class RabbitMQ
 */
class RabbitMQ {

    private $connection; //连接

    private $channel; //渠道

    private $logFileUrl = './log/';

    public function __construct($config)
    {
        try{
            $this->connection = new AMQPStreamConnection($config['host'], $config['port'], $config['user'], $config['password']);
            if(!$this->connection){
                throw new \Exception('连接失败');
            }
            $this->channel = $this->connection->channel();
        }catch (\Exception $e){
            $this->writeLog("file:{$e->getFile()};line:{$e->getLine()};message:{$e->getMessage()}");
        }
    }

    /**
     * @note:添加队列
     * @param $data  数据
     * @param $callbackString  命名空间加函数名称用'::'隔开 命名空间必须和路由一致
     * @param $name  名称
     * @param $expireTime  延迟时间 单位秒
     */
    public function pushMessage($data,$callbackString,$name,$expireTime){
        try{
            $expire_exchange_name = 'expire_'.$name.'_'.$expireTime;
            $expire_queue_name = 'expire_'.$name.'_'.$expireTime;
            $delay_exchange_name = 'delay_exchange';

            $this->channel->exchange_declare($delay_exchange_name, 'direct',false,true,false);
            $this->channel->exchange_declare($expire_exchange_name, 'direct',false,true,false);

            $tale = new AMQPTable();
            $tale->set('x-dead-letter-exchange', $delay_exchange_name);
            $tale->set('x-dead-letter-routing-key',$delay_exchange_name);
            $tale->set('x-message-ttl',$expireTime*1000);
            $this->channel->queue_declare($expire_queue_name,false,true,false,false,false,$tale);
            $this->channel->queue_bind($expire_queue_name, $expire_exchange_name,'');

            $this->channel->queue_declare('delay_queue',false,true,false,false,false);
            $this->channel->queue_bind('delay_queue', $delay_exchange_name,$delay_exchange_name);
            $data['callback'] = $callbackString;
            $arr = http_build_query($data);

            $msg = new AMQPMessage($arr,array(
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            ));

            $this->channel->basic_publish($msg,$expire_exchange_name,'');
            echo date('Y-m-d H:i:s')." [x] Sent $arr || $expireTime ".PHP_EOL;
        }catch (\Exception $e){
            echo "error(file:{$e->getFile()};line:{$e->getLine()};message:{$e->getMessage()})";
            $this->writeLog("file:{$e->getFile()};line:{$e->getLine()};message:{$e->getMessage()}");
        }
    }

    /**
     * @note:消费队列
     */
    public function outMessage(){
        try{
            $delay_exchange_name = 'delay_exchange';
            $this->channel->exchange_declare($delay_exchange_name, 'direct',false,true,false);
            $this->channel->exchange_declare('expire_exchange', 'direct',false,true,false);

            $this->channel->queue_declare('delay_queue',false,true,false,false,false);
            $this->channel->queue_bind('delay_queue', $delay_exchange_name,$delay_exchange_name);

            echo ' [*] Waiting for message. To exit press CTRL+C '.PHP_EOL;

            $callback = function ($msg){
                try{
                    echo date('Y-m-d H:i:s')." [x] Received",$msg->body,PHP_EOL;
                    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
                }catch (\Exception $e){
                    $this->writeLog("file:{$e->getFile()};line:{$e->getLine()};message:{$e->getMessage()}");
                }
            };
            //只有consumer已经处理并确认了上一条message时queue才分派新的message给它
            $this->channel->basic_qos(null, 1, null);
            $this->channel->basic_consume('delay_queue','',false,false,false,false,$callback);


            while (count($this->channel->callbacks)) {
                $this->channel->wait();
            }
        }catch (\Exception $e){
            echo "error(file:{$e->getFile()};line:{$e->getLine()};message:{$e->getMessage()})";
            $this->writeLog("file:{$e->getFile()};line:{$e->getLine()};message:{$e->getMessage()}");
        }
    }

    /**
     * @note:记录日志
     * @param $data
     */
    public function writeLog($data){
        $years = date('Y-m');

        //设置路径目录信息
        $url = $this->logFileUrl.$years.'/'.date('Ymd').'_request_log.txt';
        $dir_name=dirname($url);
        //目录不存在就创建
        if(!file_exists($dir_name))
        {
            //iconv防止中文名乱码
            $res = mkdir(iconv("UTF-8", "GBK", $dir_name),0777,true);
        }
        $fp = fopen($url,"a");//打开文件资源通道 不存在则自动创建
        fwrite($fp,var_export($data,true)."\r\n");//写入文件
        fclose($fp);//关闭资源通道
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}