<?php
$obj = new Redis();
$res = $obj->connect('127.0.0.1',6379);
// 入队列操作
// $i =1;
// while ($i < 100) {
//     $obj->lpush('list1','A_'.date("Y-m-d H:i:s"));
//     sleep(rand()%3);
//     echo $i;
//     $i++;
// }

// 出队列操作
// while (true) {
//     try{
//         var_export($obj->blPop('list1',10));
//     }catch(Exception $e){
//         echo $e->getMessage();
//     }
// }