<?php
/**
 * @Author: anchen
 * @Date:   2018-04-20 17:25:29
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-04-23 14:58:15
 */
$header = array(
            'Content-Type: application/json',
);
$data = '{"bmOrderId":"159","total":3600,"product":{"id":"PINGAN20180116001","name":"\u94bb\u77f3\u8ba1\u5212","packageCode":"C"},"applicant":{"name":"\u5317\u4eac\u6591\u9a6c\u65c5\u6e38\u6709\u9650\u516c\u53f8\u4e0a\u6d77\u6b4c\u6668\u65c5\u6e38\u670d\u52a1\u5206\u516c\u53f8","cardType":"95","cardId":"91310115MA1K3KTQ5F","phone":"13162590168"},"insured":[{"name":"\u7a46\u53cb\u7476","cardType":"03","cardId":"123","birthday":"2018-12-28","sex":1}],"effect":"2018-05-03 00:00:00","expire":"2018-05-06 23:59:59","destination":"\u6d77\u5357"}';
$url = 'http://180.167.23.130:8103/sunshineInsurance/createOrder';
// $url = 'http://180.167.23.130:8103/sunshineInsurance/cancelOrder';
$res = curlRequest($url,$data,$header);
var_dump($res);die;
$data = '{"policyNo":"10200001900247525185"}';
$res = curlRequest($url,$data,$header);
var_dump($res);

function curlRequest($url, $data = null, $header = null, $time = 30)
{
    //初始化
    $curl = curl_init();
    //设置url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置https
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    //如果传递了数据，则使用POST请求
    if (!is_null($data)) {
        //开启post模式
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    //设置header
    /*
        $header = array(
            'apikey: 您自己的apikey',
        );
    */
    if (!is_null($header)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }
    //结果返回成字符串  如果是0  则是直接输出
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //只需要设置一个秒的数量就可以
    curl_setopt($curl, CURLOPT_TIMEOUT,$time);
    //执行
    $output = curl_exec($curl);
    //释放资源
    curl_close($curl);
    return $output;
}