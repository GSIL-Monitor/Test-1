<?php
require_once '../db.php';
$db = new DB();

$where = '';
if(isset($_GET['out_day']) && $_GET['out_day'] == '否'){
    $where .= " and datediff(NOW() ,production_date) >= period ";
}

if(isset($_GET['out_day']) && $_GET['out_day'] == '是'){
    $where .= " and datediff(NOW() ,production_date) < period ";
}
if(isset($_GET['name']) && $_GET['name']){
    $where .= " and name like '%{$_GET['name']}%'";
}
// 获取动物类别
$sql = "select * from food where 1 {$where} order by id desc";
$list = $db->execute_dql($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>饲料列表</title>
</head>
<body>
    <?php include '../navibar.php' ?>
    <h1>饲料列表</h1>

    <form action="" method="get">
        饲料名：<input placeholder="模糊搜索饲料名" type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"/>
        是否过期：
        <input type="radio" name="out_day" value="" <?php echo !isset($_GET['out_day']) || $_GET['out_day']== '' ? 'checked' : '' ?>/>全部
        <input type="radio" name="out_day" value="是" <?php echo isset($_GET['out_day']) && $_GET['out_day']== '是' ? 'checked' : '' ?>/>是
        <input type="radio" name="out_day" value="否" <?php echo isset($_GET['out_day']) && $_GET['out_day']== '否' ? 'checked' : '' ?>/>否
        <button type="submit">搜索</button>
    </form>

    <a href="foodAdd.php">添加</a>
    <table border="1px">
        <tr>
            <th>饲料名</th>
            <th>生产日期</th>
            <th>保质期</th>
            <th>价格</th>
            <th>库存</th>
            <th>进货渠道</th>
            <th>使用方法</th>
            <th>适用类别</th>
            <th>操作</th>
        </tr>
        <?php if(count($list) == 0){?>
            <tr><td colspan="9">暂无数据</td></tr>
        <?php }else{?>
            <?php foreach($list as $info){?>
            <tr>
                <td><?php echo $info['name']?></td>
                <td><?php echo $info['production_date']?></td>
                <td><?php echo $info['period']?></td>
                <td><?php echo $info['price']?></td>
                <td><?php echo $info['stock'] . $info['unit']?></td>
                <td><?php echo $info['channel']?></td>
                <td><?php echo $info['method']?></td>
                <td><?php echo $info['object']?></td>
                <td><a href="./foodEdit.php?id=<?php echo $info['id']?>">编辑</a> | <a href="./foodDel.php?id=<?php echo $info['id']?>">删除</a></td>
            </tr>
            <?php }?>
        <?php }?>
    </table>
</body>
</html>
