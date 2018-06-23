<?php
require_once '../db.php';
$db = new DB();
$where = '';
if(isset($_GET['nickname']) && $_GET['nickname']){
    $where .= " and a.nickname like '%{$_GET['nickname']}%'";
}
if(isset($_GET['health']) && $_GET['health']){
    $where .= " and a.health = '{$_GET['health']}'";
}
// 获取物种列表
$sql = "select a.*,b.name from animal a left join species b on b.id=a.species_id where 1 {$where} order by a.id desc";
$list = $db->execute_dql($sql);
$health = isset($_GET['health']) ? $_GET['health'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>动物列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>
    <h1>动物列表</h1>
    <form action="" method="get">
        <input type="text" name="nickname" value="<?php echo isset($_GET['nickname']) ? $_GET['nickname'] : ''?>">
        <select name="health">
            <option value="">--全部--</option>
            <option value="良好健康" <?php echo $health == '良好健康'? 'selected' : '' ?>>良好健康</option>
            <option value="一般健康" <?php echo $health == '一般健康'? 'selected' : '' ?>>一般健康</option>
            <option value="轻微疾病" <?php echo $health == '轻微疾病'? 'selected' : '' ?>>轻微疾病</option>
            <option value="中度疾病" <?php echo $health == '中度疾病'? 'selected' : '' ?>>中度疾病</option>
            <option value="重度疾病" <?php echo $health == '重度疾病'? 'selected' : '' ?>>重度疾病</option>
        </select>
        <button type="submit">搜索</button>
    </form>
    <a href="animalAdd.php">添加</a>
    <table border="1px">
        <tr>
            <th>编号</th>
            <th>昵称</th>
            <th>年龄</th>
            <th>性别</th>
            <th>物种</th>
            <th>健康</th>
            <th>特殊需求</th>
            <th>类别</th>
            <th>操作</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="9">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['number']?></td>
                <td><?php echo $info['nickname']?></td>
                <td><?php echo $info['age']?></td>
                <td><?php echo $info['sex']?></td>
                <td><?php echo $info['name']?></td>
                <td><?php echo $info['health']?></td>
                <td><?php echo $info['requirement']?></td>
                <td><?php echo $info['category']?></td>
                <td><a href="./animalEdit.php?id=<?php echo $info['id']?>">编辑</a> | <a href="./animalDel.php?id=<?php echo $info['id']?>">删除</a> | <a href="./feed.php?id=<?php echo $info['id']?>">喂养</a>
                <?php if($info['health'] != '良好健康'){?>
                 | <a href="./health.php?id=<?php echo $info['id']?>">医疗</a>
                <?php }?>
                </td>
            </tr>
            <?php }?>
        <?php }?>

    </table>
</body>
</html>
