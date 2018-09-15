<?php
// 这个是从数据库取出来的json格式邮件详细信息
$json = '{
    "id": "135",
    "sender": "sender@qq.com",
    "sender_name": "我是发件人",
    "to_name": "收件人1,收件人2,ymy",
    "to_list": "wusong@qq.com,liangso@qq.com,ymy@qq.com",
    "cc_list": "抄送人",
    "cc_name": "cc1@qq.com",
    "title": "我是主题",
    "content": "<p>测试一下！！！{43575}<br></p>",
    "email_time": "2018-09-15 09:56:05",
    "create_time": "2018-09-15 09:56:05",
    "update_time": "2018-09-15 09:56:05"
}';
$mailDetail = json_decode($json, true);

$str = "";
// 邮件日期（后面的+0800是北京时间的时区）
$str .= "Date: {$mailDetail['email_time']} +0800".PHP_EOL;

// 处理收件人
$str .= "To: ";
$toName = explode(',', $mailDetail['to_name']);
$toEmail = explode(',', $mailDetail['to_list']);
foreach ($toName as $k => $name){
    $str .= "$name <$toEmail[$k]>";
    if($k+1 != count($toName)){
        $str .= ", ";
    }else{
        $str .= PHP_EOL;
    }
}

// 处理抄送人
$ccName = explode(',', $mailDetail['cc_name']);
$ccEmail = explode(',', $mailDetail['cc_list']);
if(!empty($ccName)){
    $str .= "Cc: ";
    foreach ($ccName as $k => $name){
        $str .= "$name <$ccEmail[$k]>";
        if($k+1 != count($ccName)){
            $str .= ", ";
        }else{
            $str .= PHP_EOL;
        }
    }
}

// 发件人
$str .= "From: {$mailDetail['sender']} <{$mailDetail['sender_name']}>".PHP_EOL;

// 邮件主题
$str .= "Subject: {$mailDetail['title']}". PHP_EOL;

// 邮件输出格式
$str .= "MIME-Version: 1.0". PHP_EOL;
$str .= "Content-Type: text/html; charset=UTF-8". PHP_EOL;
$str .= "Content-Transfer-Encoding: 8bit". PHP_EOL;

// 邮件内容
$str .= PHP_EOL . "{$mailDetail['content']}".PHP_EOL;

// 保存
file_put_contents('test.eml', $str);