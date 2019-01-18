<?php
require __DIR__.'/RabbitMQ.php';
$config = [ 'host'=>'127.0.0.1', 'port'=>5672, 'user'=>'test', 'password'=>'123456' ];
$RabbitMQ = new RabbitMQ($config); $data['abc'] = rand();
$RabbitMQ->pushMessage($data,'test\\test::ccc','demo',30);die;