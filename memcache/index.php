<?php
$memcache = new Memcache();
$memcache->connect('127.0.0.1',11211) or die('shit');
$key1 = MD5('wusong1089@dingtalk.com');
$key2 = 'wusong1089@dingtalk.com';
// $memcache->set($key1,'17602141089');
// $memcache->set($key2,'hello memcache!');

$out = $memcache->get($key1);
echo $out;
echo '<hr>';
$out = $memcache->get($key2);
echo $out;