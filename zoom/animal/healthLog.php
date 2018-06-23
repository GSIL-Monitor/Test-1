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
if(isset($_GET['doctor_id']) && $_GET['doctor_id']){
    $where .= " and a.doctor_id = '{$_GET['doctor_id']}'";
}
// 获取物种列表
$sql = "select a.record_time,b.nickname animal_name,c.name doctor_name,a.new,a.old,a.remark
from health_log a
left join animal b on b.id=a.animal_id
left join doctor c on a.doctor_id=c.id
where 1 {$where}
order by a.id desc";
$list = $db->execute_dql($sql);

// 动物信息
$sql = "select * from animal";
$animalList = $db->execute_dql($sql);

// 兽医信息
$sql = "select * from doctor ";
$doctorList = $db->execute_dql($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>治疗记录</title>
</head>
<body>
    <?php include '../navibar.php' ?>

    <h1>治疗记录</h1>
    <form action="" method="get">
        开始时间：<input type="text" name="start_time" value="<?php echo isset($_GET['start_time']) ? $_GET['start_time'] : ''?>" />
        结束时间：<input type="text" name="end_time" value="<?php echo isset($_GET['end_time']) ? $_GET['end_time'] : ''?>" />
        动物：<select name="animal_id">
            <option value="">--全部--</option>
            <?php foreach($animalList as $animal){?>
            <option value="<?php echo $animal['id']?>"  <?php if(isset($_GET['animal_id']) && $_GET['animal_id'] == $animal['id'])echo "selected"?>><?php echo $animal['nickname']?></option>
            <?php }?>
        </select>
        兽医：<select name="doctor_id">
            <option value="">--全部--</option>
            <?php foreach($doctorList as $doctor){?>
            <option value="<?php echo $doctor['id']?>"  <?php if(isset($_GET['doctor_id']) && $_GET['doctor_id'] == $doctor['id'])echo "selected"?>><?php echo $doctor['name']?></option>
            <?php }?>
        </select>
        <button type="submit">搜索</button>
    </form>
    <table border="1px" width="800px">
        <tr>
            <th>时间</th>
            <th>动物名称</th>
            <th>兽医</th>
            <th>治疗前</th>
            <th>治疗后</th>
            <th>备注</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="6">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['record_time']?></td>
                <td><?php echo $info['animal_name']?></td>
                <td><?php echo $info['doctor_name']?></td>
                <td><?php echo $info['old']?></td>
                <td><?php echo $info['new']?></td>
                <td><?php echo $info['remark']?></td>
            </tr>
            <?php }?>
        <?php }?>

    </table>
</body>
</html>
