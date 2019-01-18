<?php
$client1 = new Yar_Client('http://admin.bmtrip.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$client2 = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$client3 = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=operation&c=Operaterpc&a=insurance');

// $client = new Yar_Client('http://admin-all.bmtrip.com:8080/index.php?m=orangeapi&c=rpc&a=order');
// $res = $client->getOrderAndTouristInfo("71792",["18797496","145634"],["2018-11-21","2018-11-22","2018-11-23","2018-11-24","2018-11-25"]);
// var_dump($res);die;

// $client = new Yar_Client('http://admin.bmtrip.com:8080/index.php?m=Orangeapi&c=Orderapi&a=order');
// $res = $client->getOrderBaseGroup(64127);
// var_dump($res);die;

try{
    $client = new Yar_Client('http://x.com/rpc/insurance');
    $client->SetOpt(YAR_OPT_TIMEOUT, 10); // 设置RPC超时时间44751 - 44755
    $res = $client->insuranceResourcePurchase(47211,111);
    var_dump($res);die;
}catch(Exception $e){
    //     try{
    //     $client = new Yar_Client('http://x.com/rpc/insurance');
    //     $client->SetOpt(YAR_OPT_TIMEOUT, 1); // 设置RPC超时时间44751 - 44755
    //     $res = $client->insuranceResourcePurchase(45329,111);
    //     var_dump($res);die;
    // }catch(Exception $e){

    //     echo $e->getMessage();die;
    // }
    echo $e->getMessage();die;
}

// function callback($retval, $callinfo) {
//      var_dump($retval);
// }

// Yar_Concurrent_Client::call('http://x.com/rpc/resource', "haveWithGuideByIdList", [[24,25,1,2,22,23,19,20]], "callback");
// Yar_Concurrent_Client::loop();die;
// $client = new Yar_Client('http://x.com/rpc/resource');
// $res = $client->resourcePriceInfoList([["rid"=>"3144346","date"=>"2018-09-19"]]);
// echo json_encode($res);die;
// $client = new Yar_Client("http://admin.bmtrip.com:8080/index.php?m=orangeapi&c=rpc&a=vendor");
//         $client->SetOpt(YAR_OPT_TIMEOUT, 60); // 设置RPC超时时间
//         $res = $client->listOldData();
// echo json_encode($res);die;

// $client = new Yar_Client('http://x.com/rpc/resource');
// $res = $client->changeOrderIdByGroup([
//     ["resource_id"=>"162260","date"=>"2018-05-08","vender_id"=>"870","new_order_id"=>"123","old_order_id"=>"37959",'adult_count'=>'2','child_count'=>'12','guide_count'=>'1','guide_flag'=>'1','type'=>'2','id'=>878215]
//     ]);
// echo json_encode($res);die;
// $client = new Yar_Client('http://x.com/rpc/hotel');
// $res = $client->getUseFullHotel(1,2136998,'2018-10-02','2018-10-03',2,1,5755,'','2018-10-02 18:00:00','501','99239616','','');
// echo json_encode($res);die;
// // 获取订单使用人列表
// $client = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=orangeapi&c=rpc&a=order');
// $res = $client->getOrderUser([43198,43167]);
// echo json_encode($res);die;
// $client = new \Yar_Client('http://x.com/rpc/resource');
// $client = new \Yar_Client('http://172.16.1.13:8803/rpc/resource');
// $res = $client->checkResourceUsefull([["rid"=> "3144298",
//   "date"=> "2018-09-17",
//   "stock"=> 0]]);
// echo json_encode($res);die;


// $data = [
// '
// [["45652",[{"rid":"135226","date":"2018-11-16","stock":4},{"rid":"137550","date":"2018-11-16","stock":2},{"rid":"150204","date":"2018-11-16","stock":4},{"rid":"173939","date":"2018-11-16","stock":4},{"rid":"9364","date":"2018-11-17","stock":2},{"rid":"11148","date":"2018-11-17","stock":4},{"rid":"120611","date":"2018-11-17","stock":4},{"rid":"3165366","date":"2018-11-17","stock":4},{"rid":"3165425","date":"2018-11-17","stock":4}],1]]
// ','
// [["45652",[{"rid":135226,"date":"2018-11-16","stock":2},{"rid":137550,"date":"2018-11-16","stock":"1"},{"rid":150204,"date":"2018-11-16","stock":2},{"rid":173939,"date":"2018-11-16","stock":2},{"rid":9364,"date":"2018-11-17","stock":"1"},{"rid":11148,"date":"2018-11-17","stock":2},{"rid":120611,"date":"2018-11-17","stock":2},{"rid":3165366,"date":"2018-11-17","stock":2},{"rid":3165425,"date":"2018-11-17","stock":2}],0]]
// ','
// [["45653",[{"rid":"135226","date":"2018-11-16","stock":2},{"rid":"137550","date":"2018-11-16","stock":1},{"rid":"150204","date":"2018-11-16","stock":2},{"rid":"173939","date":"2018-11-16","stock":2},{"rid":"9364","date":"2018-11-17","stock":1},{"rid":"11148","date":"2018-11-17","stock":2},{"rid":"120611","date":"2018-11-17","stock":2},{"rid":"3165366","date":"2018-11-17","stock":2},{"rid":"3165425","date":"2018-11-17","stock":2}],1]]
// ','
// [["45653",[{"rid":"135226","date":"2018-11-16","stock":2},{"rid":"137550","date":"2018-11-16","stock":1},{"rid":"150204","date":"2018-11-16","stock":2},{"rid":"173939","date":"2018-11-16","stock":2},{"rid":"9364","date":"2018-11-17","stock":1},{"rid":"11148","date":"2018-11-17","stock":2},{"rid":"120611","date":"2018-11-17","stock":2},{"rid":"3165366","date":"2018-11-17","stock":2},{"rid":"3165425","date":"2018-11-17","stock":2}],1]]
// ','
// [["45652",[{"rid":"135226","date":"2018-11-16","stock":2},{"rid":"137550","date":"2018-11-16","stock":1},{"rid":"150204","date":"2018-11-16","stock":2},{"rid":"173939","date":"2018-11-16","stock":2},{"rid":"9364","date":"2018-11-17","stock":1},{"rid":"11148","date":"2018-11-17","stock":2},{"rid":"120611","date":"2018-11-17","stock":2},{"rid":"3165366","date":"2018-11-17","stock":2},{"rid":"3165425","date":"2018-11-17","stock":2}],1]]
// ','
// [["45653",[{"rid":135226,"date":"2018-11-16","stock":2},{"rid":137550,"date":"2018-11-16","stock":"1"},{"rid":150204,"date":"2018-11-16","stock":2},{"rid":173939,"date":"2018-11-16","stock":2},{"rid":9364,"date":"2018-11-17","stock":"2"},{"rid":11148,"date":"2018-11-17","stock":2},{"rid":120611,"date":"2018-11-17","stock":2},{"rid":3165366,"date":"2018-11-17","stock":2},{"rid":3165425,"date":"2018-11-17","stock":2}],0]]
// '
// ];
// foreach ($data as $key => $value) {
//     $param = json_decode($value, true)[0];
//     $client = new \Yar_Client('http://x.com/rpc/resource');
//     $res = $client->receivedStockWithoutVender($param[0],$param[1], $param[2]);
//     echo json_encode($res);
// }
// die;


// 获取货币列表
// $client = new \Yar_Client('http://172.16.1.13:8803/rpc/common/rpc/common');
// $res = $client->getCurrencyList('251');
// echo json_encode($res);die;
// 获取资源详细信息
// $client = new \Yar_Client('http://172.16.1.13:8802/rpc/multidaytour');
// $res = $client->getMultiDayTourInfoByIdFromRPC([2946115,2951704]);
// echo json_encode($res);die;
// 是否含导
// $client = new \Yar_Client('http://172.16.1.13:8802/rpc/resource');
// $client = new \Yar_Client('http://x.com/rpc/resource');
// $res = $client->haveWithGuideByIdList([135226,320291,320290]);
// echo json_encode($res);die;

// 获取资源详细信息
// $client = new \Yar_Client('http://x.com/rpc/resource');
// $res = $client->getResourceInfoByIdList([10,5163,14497,16764,18091,21701,32019,49032,2308,1250,3972,19115,21688,3290,32143,143528,29,31,32,21,3143387,3165434]);
// echo '<pre>';
// echo json_encode($res);die;
// var_dump($res);die;
// // 基础信息
// $client = new \Yar_Client('http://x.com/rpc/Common');
// $res = $client->getVenderList();
// echo json_encode($res);die;
// 多日游列表
$client = new \Yar_Client('http://x.com/rpc/multidaytour');
$res = $client->getMultiDayTourList(['pageNo'=>5,'pageSize'=>2]);
echo json_encode($res);die;
// 获取签证详细信息
// $visa = new Yar_Client('http://172.16.1.13:8803/rpc/visa/rpc/visa');
// $res = $visa->visaPriceInfo(2540673);
// echo json_encode($res);die;
// try{
//     $client = new Yar_client("http://admin.bmtrip.com:8080/index.php?m=Operation&c=Operaterpc&a=demand");
//     $res = $client->getHotelOTADemandByOrderId(['order_id'=>[48619]]);
//     echo json_encode($res);die;
// }catch(Exception $e){
//     echo $e->getMessage();die;
// }

// 批量操作库存
echo date('H:i:s');
$client = new Yar_Client('http://x.com/rpc/resource');
$client = new Yar_Client('http://172.16.1.13:8803/rpc/resource');
$res = $client->operateVenderStock([['order_id'=>45255,'rid'=>1188874,'sid'=>870,'date'=>'2018-12-15',
    'total'=>1]]);
echo date('H:i:s');
var_dump($res);die;

// 获取需求单信息
// $client = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=Operation&c=Operaterpc&a=demand');
// $res = $client->getDemandsByIdList([['demand_id' => '1452749','demand_type' => 1]]);
// var_dump($res);die;

// 获取酒店子房型数据
// $client = new Yar_Client('http://x.com/rpc/hotelroom');
// $res = $client->getHotelRoomList(2092);
// echo json_encode($res);die;

// $client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
// $res = $client1->getFinanceStatusByPurchaseId(519435);
// echo json_encode($res);die;
// // 获取订单
// $client = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=orangeapi&c=rpc&a=order');
// $res = $client->getTouristOrderInfoByTouristIds([1279768,1279769,1279770]);
// echo json_encode($res);die;
// 获取需求单37630
// try{
//     $client2->SetOpt(YAR_OPT_TIMEOUT, 60);
//     $res = $client2->getOrderInsuranceDemands(['order_id'=>[39564],'status'=>[0,2,4]]);
//     echo json_encode($res);die;
// }catch(Exception $e){
//     echo $e->getMessage();die;
// }

// 获取投退保记录
// $visa = new Yar_Client('http://x.com/rpc/insurance');
// $res = $visa->getInsuranceOrderLog([879890,879891,'879889']);
// echo json_encode($res);die;
// 获取可用签证
// $visa = new Yar_Client('http://180.167.23.130:8802/rpc/visa');
// $res = $visa->getVisaList();
// echo json_encode($res);die;
// 合并采购单
// $client = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=operation&c=Operaterpc&a=insurance');
// $res = $client->createPurchaseByDirectResource(37591,[['id'=>'7b4717028f07849b5d20629327360723','type'=>3]],856,2,0,477767,'平安保险-钻石计划（21~30天）');
// echo '合并采购单';
// echo json_encode($res);die;

// 更新报价
$client = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=operation&c=OperateRpc&a=insurance');
$order_id=44891;
$banma_order_id = 487250;
$data = [
    'session_id'=>1066,
    "vender_id"=>"862",
    "purchasing_time"=>"2018-10-23",
    "info"=>[
        "remark"=>['4F00010061666D73CE5B0000'],
        "booking_price"=>"19"
    ],
    "attachment2"=>[["system_id"=>13,"file_id"=>62094,"name"=>" 保单-YQH45091-2018.10.24-平安保险-1人-487.pdf"]]
];
$res = $client3->quotePurchase($order_id,$banma_order_id,$data);
echo '更新报价';
echo json_encode($res);die;

// 生成采购单
// $client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
// $res = $client->createPurchaseByInsuranceDirect(37591,[['id'=>'6097980dd1da02035ef2e3773fbf6345','type'=>3]],856,2,0,0,'平安保险-钻石计划（21~30天）');
// echo '生成采购单';
// echo json_encode($res);die;

// 获取签证详细信息
// $visa = new Yar_Client('http://x.com/rpc/insurance');
// $res = $visa->validateInsuranceResource([111,222,137145,162050]);
// echo json_encode($res);die;
//

// 获取签证详细信息
// $visa = new Yar_Client('http://180.167.23.130:8802/rpc/visa');
// $res = $visa->getVisaList();
// echo json_encode($res);die;
// 获取保险行程订单RPC接口
// $order = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=orangeapi&c=rpc&a=order');
// $res = $order->insuranceOrderList(1,7);
// echo json_encode($res);die;

// $purchaseClient = new Yar_Client('http://plato-dev.bmtrip.com/index.php?m=operation&c=operaterpc&a=purchase');
// $res = $purchaseClient->getPurchaseIdByDemandId(['1']);
// echo json_encode($res);die;

// $param = json_decode('{"vender_id":"856","purchasing_time":"2018-04-02","info":{"remark":["p2"],"booking_price":"22.00","currency_id":1}}', true);
// $client = new \Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
// echo json_encode($param);
// $res = $client->quotePurchase(37491,10,$param);
// echo json_encode($res);die;
// $usable_visa_resource_id_list = [3,1];
// $visa_id_list=[1,2];
// $left_visa_id_list = array_intersect($visa_id_list,$usable_visa_resource_id_list);
// echo json_encode($left_visa_id_list);die;

// $client = new \Yar_Client('http://x.com/rpc/visa');
// $res = $client->getVisaList(["usable_flag"=>1,"usable_date"=>"2018-04-01"]);
// echo json_encode($res);die;



// $client = new \Yar_Client('http://172.16.41.224/resource/public/index.php/rpc/insurance');
// $client = new \Yar_Client('http://172.16.1.13:8803/rpc/insurance');
// $res = $client->checkResourceIsInsurance([1,2,162050,162051]);
// echo json_encode($res);die;
// $client = new Yar_Client('http://admintest.banma_cefu.com:8080/index.php?m=orangeapi&c=rpc&a=order');
// $res = $client->insuranceOrderList(37441);
// echo json_encode($res);die;

$client = new Yar_Client('http://admin.bmtrip.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$res = $client->checkOrderInfo(62096);
echo json_encode($res);die;

// $client = new Yar_Client('http://x.com/rpc/resource');
// $res = $client->getResourceList([]);
// echo json_encode($res);die;
// $client = new Yar_Client('http://x.com/rpc/visa');
// $res = $client->getVisaList(['usable_flag'=>1,'usable_date'=>'2011-11-11']);
// echo json_encode($res);die;
$client = new Yar_Client('http://admin.bmtrip.com:8080/index.php?m=operation&c=Operaterpc&a=insurance');
$res = $client->getOrderInsuranceDemands(['status'=>[1,2],'order_id'=>[63420,63428,63467,63478,63522,63532,63534,63538,63555,63593,63596,63627,63663,63693,63695,63697,63698,63716,63720,63735,63743,63748,63752,63766,63780,63787,63802]]);
echo json_encode($res);die;

$param['order_id'] = [37491];
$param['status'] = [0,1,4,5,6,7,8,9,11,12,2,10,3];
$result = $client->getOrderInsuranceDemands($param);
echo json_encode($result);die;
die;
