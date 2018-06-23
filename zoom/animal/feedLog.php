<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['start_time']) && $_GET['start_time']){
    $where .= " and a.record_time >= '{$_GET['start_time']}'";
}
if(isset($_GET['end_time']) && $_GET['end_time']){
    $where .= " and a.record_time <= '{$_GET['end_time']}'";
}
if(isset($_GET['animal_id']) && $_GET['animal_id']){
    $where .= " and a.animal_id = '{$_GET['animal_id']}'";
}
if(isset($_GET['food_id']) && $_GET['food_id']){
    $where .= " and a.food_id = '{$_GET['food_id']}'";
}
if(isset($_GET['feeder_id']) && $_GET['feeder_id']){
    $where .= " and a.feeder_id = '{$_GET['feeder_id']}'";
}
// 获取物种列表
$sql = "select a.record_time,b.nickname animal_name,c.name food_name ,d.name feeder_name,a.use_stock
from feed_log a
left join animal b on b.id=a.animal_id
left join food c on a.food_id=c.id
left join feeder d on d.id=a.feeder_id
where 1 {$where}
order by a.id desc";
$list = $db->execute_dql($sql);

// 动物信息
$sql = "select * from animal";
$animalList = $db->execute_dql($sql);

// 饲养员列表
$sql = "select * from feeder";
$feederList = $db->execute_dql($sql);

// 饲料信息
$sql = "select * from food ";
$foodList = $db->execute_dql($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>喂养记录</title>
</head>
<body>
    <?php include '../navibar.php' ?>
    <h1>喂养记录</h1>
    <form action="" method="get">
        开始时间：<input type="text" name="start_time" value="<?php echo isset($_GET['start_time']) ? $_GET['start_time'] : ''?>" />
        结束时间：<input type="text" name="end_time" value="<?php echo isset($_GET['end_time']) ? $_GET['end_time'] : ''?>" />
        动物：<select name="animal_id">
            <option value="">--全部--</option>
            <?php foreach($animalList as $animal){?>
            <option value="<?php echo $animal['id']?>"  <?php if(isset($_GET['animal_id']) && $_GET['animal_id'] == $animal['id'])echo "selected"?>><?php echo $animal['nickname']?></option>
            <?php }?>
        </select>
        饲养员：<select name="feeder_id">
            <option value="">--全部--</option>
            <?php foreach($feederList as $feeder){?>
            <option value="<?php echo $feeder['id']?>"  <?php if(isset($_GET['feeder_id']) && $_GET['feeder_id'] == $feeder['id'])echo "selected"?>><?php echo $feeder['name']?></option>
            <?php }?>
        </select>
        饲料：<select name="food_id">
            <option value="">--全部--</option>
            <?php foreach($foodList as $food){?>
            <option value="<?php echo $food['id']?>"  <?php if(isset($_GET['food_id']) && $_GET['food_id'] == $food['id'])echo "selected"?>><?php echo $food['name']?></option>
            <?php }?>
        </select>
        <button type="submit">搜索</button>
    </form>
    <table border="1px" width="800px">
        <tr>
            <th>时间</th>
            <th>动物名称</th>
            <th>饲养员</th>
            <th>食物</th>
            <th>投喂量</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="5">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['record_time']?></td>
                <td><?php echo $info['animal_name']?></td>
                <td><?php echo $info['feeder_name']?></td>
                <td><?php echo $info['food_name']?></td>
                <td><?php echo $info['use_stock']?></td>
            </tr>
            <?php }?>
        <?php }?>

    </table>
</body>
</html>
