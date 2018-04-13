<?php
set_time_limit(0);
$url = 'http://localhost/test/redis/setnx/setnx_1.php';
$mh = curl_multi_init();
$limit = 100;
for ($i = 0  ; $i < $limit; $i++) {
     $conn[$i]=curl_init($url);
      curl_setopt($conn[$i],CURLOPT_RETURNTRANSFER,1);
      curl_multi_add_handle ($mh,$conn[$i]);
}
do { $n=curl_multi_exec($mh,$active); } while ($active);
for ($i = 0 ; $i < $limit; $i++) {
      $res[$i]=curl_multi_getcontent($conn[$i]);
      curl_close($conn[$i]);
}
print_r($res);die;
