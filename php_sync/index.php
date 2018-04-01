<?php

echo '你看到了我，但是我仍然在干活！'.PHP_VERSION ;
close_connect();

//模拟后台执行复杂任务
for ($i = 0; $i < 5; $i++) {
    file_put_contents(__DIR__.'/a.log', "i={$i}我仍然在干活！\r\n", FILE_APPEND);
    sleep(1);
}

//强制输出结果到浏览器并断开连接
function close_connect(){
    ignore_user_abort(true);
    set_time_limit(0);
    $size=ob_get_length();
    header("Content-Length: $size");
    header("Content-type:text/html;charset=utf-8");
    header("Connection: Close");
    ob_flush();
    flush();
}

// 这里说明一下，只有PHP版本是 ts 的才能成功，nts不行