<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['start_time']) && $_GET['start_time']){
    $where .= " and message.record_time >= '{$_GET['start_time']}'";
}
if(isset($_GET['end_time']) && $_GET['end_time']){
    $where .= " and message.record_time <= '{$_GET['end_time']}'";
}
// 获取物种列表
$sql = "select message.*,food.name from message left join food on message.food_id = food.id where 1 {$where} order by id desc";
$list = $db->execute_dql($sql);
// 更新所有消息已读
$sql = "update message set flag='是'";
$db->execute_dml($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>消息列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>
    <h1>消息列表</h1>
    <form action="" method="get">
        开始时间：<input type="text" name="start_time" value="<?php echo isset($_GET['start_time']) ? $_GET['start_time'] : ''?>" />
        结束时间：<input type="text" name="end_time" value="<?php echo isset($_GET['end_time']) ? $_GET['end_time'] : ''?>" />
        <button type="submit">搜索</button>
    </form>
    <table border="1px">
        <tr>
            <th>记录时间</th>
            <th>消息内容</th>
            <th>饲料名</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="2">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['record_time']?></td>
                <td><?php echo $info['message']?></td>
                <td><?php echo $info['name']?></td>
            </tr>
            <?php }?>
        <?php }?>
    </table>
</body>
</html>
