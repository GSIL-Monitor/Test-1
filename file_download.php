<?php
$url = 'http://oss.anyitech.ltd/ws_oss_service/storage/file_download/61740100390B7FE6DE5A00001';
$file_path = '';
$file_name = date('ymd').md5($url).'.pdf';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,  CURLOPT_SSL_VERIFYHOST, false);
$data = curl_exec($curl);var_dump($data);
if (curl_errno($curl)){
    echo 'error'.curl_error($curl);
}
curl_close($curl);
$file = fopen($file_path.$file_name, "w");
fwrite($file, $data);
echo  $file_path.$file_name;
?>