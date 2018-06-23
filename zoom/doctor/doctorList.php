<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['area']) && $_GET['area']){
    $where .= " and area = '{$_GET['area']}'";
}
if(isset($_GET['name']) && $_GET['name']){
    $where .= " and name like '%{$_GET['name']}%'";
}

// 获取兽医列表
$sql = "select * from doctor where 1 {$where} order by id desc";
$list = $db->execute_dql($sql);
// 获取区域列表
$sql = "select * from doctor group by area";
$areaList = $db->execute_dql($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>兽医列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>
    <h1>兽医列表</h1>

    <form action="" method="get">
        姓名：<input placeholder="模糊搜索姓名" type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"/>
        区域：<select name="area">
            <option value="">--全部--</option>
            <?php foreach($areaList as $info){?>
            <option value="<?php echo $info['area']?>"  <?php if(isset($_GET['area']) && $_GET['area'] == $info['area'])echo "selected"?>><?php echo $info['area']?></option>
            <?php }?>
        </select>
        <button type="submit">搜索</button>
    </form>
    <a href="doctorAdd.php">添加</a>
    <table border="1px">
        <tr>
            <th>姓名</th>
            <th>年龄</th>
            <th>工龄</th>
            <th>区域</th>
            <th>操作</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="5">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['name']?></td>
                <td><?php echo $info['age']?></td>
                <td><?php echo $info['work_years']?></td>
                <td><?php echo $info['area']?></td>
                <td><a href="./doctorEdit.php?id=<?php echo $info['id']?>">编辑</a> | <a href="./doctorDel.php?id=<?php echo $info['id']?>">删除</a></td>
            </tr>
            <?php }?>
        <?php }?>
    </table>
</body>
</html>
