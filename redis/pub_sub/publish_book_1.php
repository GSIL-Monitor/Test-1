<?php
//发布
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$message='Hello菜菜'.rand().PHP_EOL;
$ret=$redis->publish('test',$message);