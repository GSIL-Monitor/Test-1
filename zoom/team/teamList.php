<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['name']) && $_GET['name']){
    $where .= " and team.name like '%{$_GET['name']}%'";
}
// 获取物种列表
$sql = "select team.*,count(team_id) total from team LEFT JOIN feeder on team.id=feeder.team_id where 1 {$where} GROUP BY team.id order by team.id desc";
$list = $db->execute_dql($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>饲养队列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>

    <h1>饲养队列表</h1>
     <form action="" method="get">
        队名：<input placeholder="模糊搜索队名" type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"/>
        <button type="submit">搜索</button>
    </form>
    <a href="teamAdd.php">添加</a>
    <table border="1px">
        <tr>
            <th>队名</th>
            <th>区域</th>
            <th>队员人数</th>
            <th>操作</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="4">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['name']?></td>
                <td><?php echo $info['area']?></td>
                <td><?php echo $info['total']?></td>
                <td><a href="./teamEdit.php?id=<?php echo $info['id']?>">编辑</a> | <a href="./teamDel.php?id=<?php echo $info['id']?>">删除</a></td>
            </tr>
            <?php }?>
        <?php }?>
    </table>
</body>
</html>
