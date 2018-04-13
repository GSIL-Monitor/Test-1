<?php
//订阅
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$result=$redis->subscribe(array('test'), 'callback');
function callback($instance,$channelName,$message){
    echo $message;
    $instance->close();
}