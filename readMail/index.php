<?php
include('readMail.class.php');
//@header('Content-type: text/html;charset=UTF-8');
//error_reporting(0);
//ignore_user_abort(); // run script in background
set_time_limit(0); // run script forever
//date_default_timezone_set('Asia/Shanghai');
class EmController
{
    //定义系统常量
    //用户名
    public $mailAccount = "";
    public $mailPasswd = "";
    public $mailAddress = "";
    public $mailServer = "imap.exmail.qq.com";
    public $serverType = "imap";
    public $port = "993";
    public $now = '';
    public $savePath = '';
    public $webPath = "./upload/";
    public $user = ['user_id'=>101,'user_name'=>'wusong','real_name'=>'伍松'];
    public function __construct()
    {
        $this->now = time();
        $this->setSavePath();
    }

    /**
     * mail Received()读取收件箱邮件
     *
     * @param
     * @access public
     * @return result
     */
    public function mailReceived()
    {
        // Creating a object of reciveMail Class
//        $obj= new receivemail($this->mailAccount,$this->mailPasswd,$this->mailAddress,$this->mailServer,$this->serverType,$this->port,false);
         $obj = new Receivemail($this->mailAccount, $this->mailPasswd, $this->mailAddress, $this->mailServer, $this->serverType, $this->port, false);
       //Connect to the Mail Box
        $res=$obj->connect();         //If connection fails give error message and exit
//        if (!$res)
//        {
//            return array("msg"=>"Error: Connecting to mail server");
//        }
        // Get Total Number of Unread Email in mail box
        $tot=$obj->getTotalMails(); //Total Mails in Inbox Return integer value

        if(0 == $tot) { //如果信件数为0,显示信息
            return array("msg"=>"No Message for ".$this->mailAccount);
        }
        else
        {
            $res=array("msg"=>"Total Mails:: $tot<br>");

            for($i=20;$i>0;$i--)
            {
                $head=$obj->getHeaders($i);  // Get Header Info Return Array Of Headers **Array Keys are (subject,to,toOth,toNameOth,from,fromName)
// var_dump($head);die;
                //处理邮件附件
                $files=$obj->GetAttach($i,$this->savePath); // 获取邮件附件，返回的邮件附件信息数组

                $imageList=array();
                foreach($files as $k => $file)
                {
                    //type=1为附件,0为邮件内容图片
                    if($file['type'] == 0)
                    {
                        $imageList[$file['title']]=$file['pathname'];
                    }
                }
                $body = $obj->getBody($i,$this->webPath,$imageList);

                $res['mail'][]=array(
                    'head'=>$head,
                    'body'=>$body,
                    "attachList"=>$files
                    );
//              $obj->deleteMails($i); // Delete Mail from Mail box
//              $obj->move_mails($i,"taskMail");
            }
            $obj->close_mailbox();   //Close Mail Box
            return $res;
        }
    }

    /**
     * creatBox
     *
     * @access public
     * @return void
     */
    public function creatBox($boxName)
    {
        // Creating a object of reciveMail Class
        $obj= new receivemail($this->mailAccount,$this->mailPasswd,$this->mailAddress,$this->mailServer,$this->serverType,$this->port,false);
        $obj->creat_mailbox($boxName);
    }

    /**
     * Set save path.
     *
     * @access public
     * @return void
     */
    public function setSavePath()
    {
        $savePath = "./upload/" . date('Ym/', $this->now);
        if(!file_exists($savePath))
        {
            @mkdir($savePath, 0777, true);
            touch($savePath . 'index.html');
        }
        $this->savePath = dirname($savePath) . '/';
    }
}

$obj=new EmController();
//收取邮件
$res=$obj->mailReceived();
print_r($res);

//     public function __construct()
//     {
//         $this->now = time();
//         // $this->user = getUserInfo();
//         $this->setSavePath();
//     }

//     /**
//      * mail Received()读取收件箱邮件
//      *
//      * @param
//      * @access public
//      * @return result
//      */
//     public function mailReceived()
//     {
//         $obj = new Receivemail($this->mailAccount, $this->mailPasswd, $this->mailAddress, $this->mailServer, $this->serverType, $this->port, false);
//         $obj->connect();
//         $tot = $obj->getTotalMails();

//         if ($tot == 0) { //如果信件数为0,显示信息
//             return array("msg" => "邮件数量 " . $this->mailAccount);
//         } else {
//             $res = array("msg" => "邮件数量:: $tot<br>");
//             for ($i = $tot; $i > 0; $i--) {
//                 $head = $obj->getHeaders($i);

//                 if ($head['seen'] != "U") {  //取未读邮件内容
//                     //处理邮件附件
//                     $files = $obj->GetAttach($i, $this->savePath);
//                     // 获取邮件附件，返回的邮件附件信息数组
//                     $imageList = array();
//                     foreach ($files as $k => $file) {
//                         //type=1为附件,0为邮件内容图片
//                         if ($file['type'] == 0) {
//                             $imageList[$file['title']] = $file['pathname'];
//                         }
//                     }

//                     if ($files) {
//                         $fileid = $this->saveFile($files); //附件入库
//                     }
//                     $body = $obj->getBody($i, $this->webPath, $imageList);
//                     $status = $obj->mailRead($i);
//                     $res['mail'][] = array('head' => $head, 'body' => $body, "attachList" => $files);
//                     $this->saveData($head, $body, $fileid);
//                 }
//             }

//             $obj->close_mailbox();   //Close Mail Box
//             return $res;
//         }
//     }

//     /**
//      * creatBox
//      *
//      * @access public
//      * @return void
//      */
//     public function creatBox($boxName)
//     {
//         // Creating a object of reciveMail Class
//         $obj = new receivemail($this->mailAccount, $this->mailPasswd, $this->mailAddress, $this->mailServer, $this->serverType, $this->port, false);
//         $obj->creat_mailbox($boxName);
//     }

//     /**
//      * Set save path.
//      *
//      * @access public
//      * @return void
//      */
//     public function setSavePath()
//     {
//         $savePath = "./upload/" . date('Ym/', $this->now);
//         if (!file_exists($savePath)) {
//             @mkdir($savePath, 0777, true);
//             touch($savePath . 'index.html');
//         }
//         $this->savePath = dirname($savePath) . '/';
//     }

//     /**
//      * 附件入库
//      */

//     public function saveFile($file)
//     {
//         $attachment = new Attachment();
//         $file_temp['module'] = Yii::$app->controller->module->id;
//         $file_temp['filename'] = $file[0]['title'];
//         $file_temp['filepath'] = ltrim($this->savePath, '.') . $file[0]['pathname'];
//         $file_temp['fileext'] = $file[0]['extension'];
//         $file_temp['userid'] = $this->user['userid'];
//         $file_temp['username'] = $this->user['realname'] . '(' . $this->user['username'] . ')';
//         $file_temp['uploadtime'] = time();
//         $file_temp['uploadip'] = ip();
//         $file_temp['authcode'] = MD5($this->savePath);
//         $file_result = $attachment->addData($file_temp);
//         if (!$file_result) {
//             $this->error('添加附件数据错误');
//         }
//         return $file_result;
//     }

//     /*
//      * 入库
//      */
//     public function saveData($head, $body, $fileid)
//     {
//         $fileid = $fileid ? $fileid : '';
//         $email_model = new Email();
//         $data = ['from' => $head['fromBy'], 'to' => $head['toList'], 'title' => $head['subject'], 'body' => $body, 'fileids' => $fileid, 'date' => time()];
//         $email_model->addData($data);
//     }

// }


// $obj = new EmController(); //self();
// $res = $obj->mailReceived();
// var_dump($res);
?>
