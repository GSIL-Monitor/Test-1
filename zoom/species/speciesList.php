<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['name']) && $_GET['name']){
    $where .= " and name like '%{$_GET['name']}%'";
}
// 获取物种列表
$sql = "select * from species where 1 {$where} order by id desc";
$list = $db->execute_dql($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>物种列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>

    <h1>物种列表</h1>

    <form action="" method="get">
        物种名：<input placeholder="模糊搜索物种名" type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"/>
        <button type="submit">搜索</button>
    </form>

    <a href="speciesAdd.php">添加</a>
    <table border="1px">
        <tr>
            <th>物种名</th>
            <th>寿命</th>
            <th>保护级别</th>
            <th>习性</th>
            <th>栖息地</th>
            <th>操作</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="6">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['name']?></td>
                <td><?php echo $info['lifetime']?></td>
                <td><?php echo $info['protection_level']?></td>
                <td><?php echo $info['habit']?></td>
                <td><?php echo $info['habitat']?></td>
                <td><a href="./speciesEdit.php?id=<?php echo $info['id']?>">编辑</a> | <a href="./speciesDel.php?id=<?php echo $info['id']?>">删除</a></td>
            </tr>
            <?php }?>
        <?php }?>

    </table>
</body>
</html>
