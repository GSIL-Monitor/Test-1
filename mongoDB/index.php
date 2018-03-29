<?php
/**
 * @Author: anchen
 * @Date:   2017-12-10 11:13:24
 * @Last Modified by:   anchen
 * @Last Modified time: 2017-12-11 09:52:01
 */
$m = new MongoClient(); // 连接
$db = $m->test; // 获取名称为 "test" 的数据库
// 创建表步骤
$collection = $db->createCollection("runoob");
// echo "集合创建成功";
// var_dump($collection);die;
// 插入数据
$collection = $db->runoob; // 选择集合
// $document = array(
//     "title" => "MongoDB",
//     "description" => "database",
//     "likes" => 101,
//     "url" => array(99,'index.php','in'=>'emm'),
//     "author", "wusong"
// );
// $insert_res = $collection->insert($document);
// echo "数据插入成功";

// 更新文档
$collection->update(array("title"=>"MongoDB 教程"), array('$set'=>array("title"=>"MongoDB de教程")));

// 移除文档
// $collection->remove(array("title"=>"MongoDB 教程"), array("justOne" => true));

// 查询数据
$cursor = $collection->find();
// 迭代显示文档标题
foreach ($cursor as $document) {
    // echo $document["title"] . "\n";
    var_dump($document);
}
?>