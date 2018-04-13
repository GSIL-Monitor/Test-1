<?php

// 合并采购单
$client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$res = $client->createPurchaseByInsuranceDirect(37591,[['id'=>'7b4717028f07849b5d20629327360723','type'=>3]],856,2,0,477767,'平安保险-钻石计划（21~30天）');
echo '合并采购单';
var_dump($res);die;

// 更新报价
$client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$order_id=37591;
$banma_order_id = 477761;
$data = [
    'session_id'=>0,
    "vender_id"=>"856",
    "purchasing_time"=>"2018-04-08",
    "info"=>[
    "remark"=>[null],
    "booking_price"=>"19.00",
    "currency_id"=>1
    ]
];
$res = $client->quotePurchase($order_id,$banma_order_id,$data);
echo '更新报价';
var_dump($res);die;

// 生成采购单
$client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$res = $client->createPurchaseByInsuranceDirect(37591,[['id'=>'6097980dd1da02035ef2e3773fbf6345','type'=>3]],856,2,0,0,'平安保险-钻石计划（21~30天）');
echo '生成采购单';
var_dump($res);die;

// 获取签证详细信息
// $visa = new Yar_Client('http://x.com/rpc/insurance');
// $res = $visa->validateInsuranceResource([111,222,137145,162050]);
// echo json_encode($res);die;
//
// 获取签证详细信息
$visa = new Yar_Client('http://x.com/rpc/visa');
$res = $visa->getVisaInfo();
var_dump($res);die;
// 获取签证详细信息
$visa = new Yar_Client('http://180.167.23.130:8802/rpc/visa');
$res = $visa->getVisaList();
var_dump($res);die;
// $order = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=orangeapi&c=rpc&a=order');
// $res = $order->insuranceOrderList();
// var_dump($res);die;

// $purchaseClient = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=operaterpc&a=purchase');
// $res = $purchaseClient->getPurchaseIdByDemandId(['1']);
// var_dump($res);die;

// $param = json_decode('{"vender_id":"856","purchasing_time":"2018-04-02","info":{"remark":["p2"],"booking_price":"22.00","currency_id":1}}', true);
// $client = new \Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
// var_dump($param);
// $res = $client->quotePurchase(37491,10,$param);
// var_dump($res);die;
// $usable_visa_resource_id_list = [3,1];
// $visa_id_list=[1,2];
// $left_visa_id_list = array_intersect($visa_id_list,$usable_visa_resource_id_list);
// var_dump($left_visa_id_list);die;

// $client = new \Yar_Client('http://x.com/rpc/visa');
// $res = $client->getVisaList(["usable_flag"=>1,"usable_date"=>"2018-04-01"]);
// echo json_encode($res);die;



// $client = new \Yar_Client('http://172.16.41.224/resource/public/index.php/rpc/insurance');
// $res = $client->checkResourceIsInsurance([1,2,162050,162051]);
// var_dump($res);die;
// $client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=orangeapi&c=rpc&a=order');
// $res = $client->insuranceOrderList(37441);
// var_dump($res);die;

// $client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
// $res = $client->checkOrderInfo(37441);
// var_dump($res);die;

// $client = new Yar_Client('http://x.com/rpc/resource');
// $res = $client->getResourceList([]);
// var_dump($res);die;
// $client = new Yar_Client('http://x.com/rpc/visa');
// $res = $client->getVisaList(['usable_flag'=>1,'usable_date'=>'2011-11-11']);
// var_dump($res);die;
$client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
// $res = $client->getOrderInsuranceDemands(['status'=>[1,2],'order_id'=>[0,2]]);
// var_dump($res);die;

$param['order_id'] = [37491];
$param['status'] = [0,1,4,5,6,7,8,9,11,12,2,10,3];
$result = $client->getOrderInsuranceDemands($param);
var_dump($result);die;
die;
