<?php
/**
 * 实现Redis分布锁
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$key        = 'order_id';   // 唯一键
$lockExpire = 60;           // 锁的有效期为60秒

echo '请求发送时间：'.microtime(true).PHP_EOL;

// 获取Redis是否存在当前键的值
$result = $redis->get($key);
//判断缓存中是否有数据
if(empty($result))
{
    // 创建锁
    $lock = $redis->setnx($key, microtime(true));
    // 满足创建锁成功即可进行操作
    if(!empty($lock))
    {
        //给锁设置生存时间
        $redis->expire($key, $lockExpire);
        //******************************
        //此处进行正常操作
        sleep(rand(10,20));
        //******************************

        // 为了幂等性，所有请求返回统一结果，所以还需要将这次结果存入Redis
        $result = 'I am result：'.microtime(true);
        $redis->set('result'.$key,$result,60);

        //以上程序走完删除锁
        //检测锁是否过期，过期锁没必要删除
        if($redis->ttl($key))
            $redis->del($key);
        echo date('Y-m-d H:i:s').'我是第一次请求的结果：',$result;
    }else{
        wait($redis,$key);
    }
}else{
    wait($redis,$key);
}

// 执行查询缓存操作
function wait($redis,$key){
    $res = $redis->get('result'.$key);
    if(empty($res)){
        sleep(2);//等待2秒后再尝试执行操作
        wait($redis,$key);
    }else{
        echo date('Y-m-d H:i:s').'我是后续请求获取缓存中的结果：'.$res;
    }
}