<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['team_id']) && $_GET['team_id']){
    $where .= " and team_id = '{$_GET['team_id']}'";
}
if(isset($_GET['name']) && $_GET['name']){
    $where .= " and a.name like '%{$_GET['name']}%'";
}
if(isset($_GET['is_captain']) && $_GET['is_captain']){
    $where .= " and a.is_captain like '%{$_GET['is_captain']}%'";
}
// 获取兽医队
$sql = "select * from team";
$teamList = $db->execute_dql($sql);

// 获取物种列表
$sql = "select a.*,b.name team_name from feeder a left join team b on a.team_id = b.id where 1 {$where} order by a.id desc";
$list = $db->execute_dql($sql);

$is_captain = isset($_GET['is_captain']) ? $_GET['is_captain'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>饲养员列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>
    <h1>饲养员列表</h1>

    <form action="" method="get">
        姓名：<input placeholder="模糊搜索姓名" type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"/>
        饲养队：<select name="team_id">
            <option value="">--全部--</option>
            <?php foreach($teamList as $team){?>
            <option value="<?php echo $team['id']?>"  <?php if(isset($_GET['team_id']) && $_GET['team_id'] == $team['id'])echo "selected"?>><?php echo $team['name']?></option>
            <?php }?>
        </select>
        是否是队长：
        <input type="radio" name="is_captain" value="" <?php echo $is_captain == '' ? 'checked' : '' ?>/>全部
        <input type="radio" name="is_captain" value="是" <?php echo $is_captain == '是' ? 'checked' : '' ?>/>是
        <input type="radio" name="is_captain" value="否" <?php echo $is_captain == '否' ? 'checked' : '' ?>/>否
        <button type="submit">搜索</button>
    </form>

    <a href="feederAdd.php">添加</a>
    <table border="1px">
        <tr>
            <th>姓名</th>
            <th>年龄</th>
            <th>工龄</th>
            <th>性别</th>
            <th>是否是队长</th>
            <th>队名</th>
            <th>操作</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="7">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['name']?></td>
                <td><?php echo $info['age']?></td>
                <td><?php echo $info['work_years']?></td>
                <td><?php echo $info['sex']?></td>
                <td><?php echo $info['is_captain']?></td>
                <td><?php echo $info['team_name']?></td>
                <td><a href="./feederEdit.php?id=<?php echo $info['id']?>">编辑</a> | <a href="./feederDel.php?id=<?php echo $info['id']?>">删除</a></td>
            </tr>
            <?php }?>
        <?php }?>
    </table>
</body>
</html>
