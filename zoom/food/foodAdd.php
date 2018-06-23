<?php
require_once '../db.php';
$db = new DB();

// 获取动物类别
$sql = "select * from animal group by category";
$category = $db->execute_dql($sql);

$name = isset($_POST['name']) ? $_POST['name'] : '';
$production_date = isset($_POST['production_date']) ? $_POST['production_date'] : '';
$period = isset($_POST['period']) ? $_POST['period'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
$stock = isset($_POST['stock']) ? $_POST['stock'] : '';
$channel = isset($_POST['channel']) ? $_POST['channel'] : '';
$method = isset($_POST['method']) ? $_POST['method'] : '';
$object = isset($_POST['object']) ? implode(',', $_POST['object']) : '';
// 新增操作
if($name && $production_date && $period && $price && $unit && $stock && $channel && $method  ){
    $sql = "insert into food(name,production_date,period,price,unit,stock,channel,method,object) values('{$name}','{$production_date}','{$period}','{$price}','{$unit}','{$stock}','{$channel}','{$method}','{$object}')";
    $db->execute_dml($sql);
    header("Location:foodList.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加饲料</title>
</head>
<body>
    <h1>添加饲料</h1>
    <form method="post">
        名称：<input type="text" name="name"/><br />
        生产日期：<input type="text" name="production_date"/><br />
        保质期：<input type="number" name="period"/><br />
        价格：<input type="text" name="price"/>元<br />
        库存：<input type="number" name="stock"/><br />
        单位：<input type="text" name="unit"/><br />
        进货渠道：<input type="text" name="channel"/><br />
        使用方法：<input type="text" name="method"/><br />
        适用类别：
        <?php foreach($category as $info){ echo $info['category']?>
        <input type="checkbox" name="object[]" value="<?php echo $info['category']?>" />
        <?php }?>
        <br />
        <button type="submit" onclick="return check(this.form)">保存</button>
    </form>
</body>
</html>
<script type="text/javascript">
    function check(form) {
        if(form.name.value=='') {
            alert("请输入名称!");
            return false;
        }
        if(form.production_date.value=='') {
            alert("请输入生产日期!");
            return false;
        }
        if(form.period.value=='') {
            alert("请输入保质期!");
            return false;
        }
        if(form.price.value=='') {
            alert("请输入价格!");
            return false;
        }
        if(form.unit.value=='') {
            alert("请输入单位!");
            return false;
        }
        if(form.stock.value=='') {
            alert("请输入库存!");
            return false;
        }
        if(form.channel.value=='') {
            alert("请输入进货渠道!");
            return false;
        }
        if(form.method.value=='') {
            alert("请输入使用方法!");
            return false;
        }
        return true;
    }
</script>
