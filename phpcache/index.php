<?php
/**
 * PHP文件缓存示例
 * @Date:   2017-12-07 16:06:17
 * @Last Modified time: 2017-12-07 16:27:26
 */

$file_name = './cache/test.php';    // 缓存文件
$expire_time = 10;  // 过期时间(秒)

if(!file_exists($file_name) || (filemtime($file_name)+$expire_time)<time()) // 文件修改时间+过期时间 如果小于当前时间，则去请求新的数据
{
    //缓存页面代码
    ob_start();
    //从内存缓存中获取页面代码
    $content = ob_get_contents();

    echo '我是正常的内容，这里可以写页面，请求数据库的信息';

    //将获取到的内容存放到缓存文件
    file_put_contents($file_name,$content);

    //清掉内存缓存
    ob_flush();

    echo '我是缓存之外的内容';  //测试是否调用了缓存文件，缓存文件不输出这句话

}
else
{
    echo '你现在看到的是缓存文件<br />';
    include($file_name);  //如果存在，调用缓存文件
}