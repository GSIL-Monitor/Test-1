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
$id = isset($_POST['id']) ? $_POST['id'] : '';

// 修改操作
if($name && $production_date && $period && $price && $unit && $stock && $channel && $method && $id){
    $sql = "update food set name='{$name}',production_date='{$production_date}',period='{$period}',price='{$price}',unit='{$unit}',stock='{$stock}',channel='{$channel}',method='{$method}',object='{$object}' where id={$id}";
    $db->execute_dml($sql);
    header("Location:foodList.php");
}

// 获取饲料信息
if(isset($_GET['id'])){
    $sql = "select * from food where id={$_GET['id']}";
    $detail = $db->get($sql);
    if(count($detail) == 0)die("id is not exist");
}else{
    die("operator forbiden");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>修改饲料信息</title>
</head>
<body>
    <h1>修改饲料信息</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $detail['id'];?>" />
        名称：<input type="text" name="name" value="<?php echo $detail['name']?>" /><br />
        生产日期：<input type="text" name="production_date" value="<?php echo $detail['production_date']?>"/><br />
        保质期：<input type="number" name="period"  value="<?php echo $detail['period']?>"/><br />
        价格：<input type="text" name="price" value="<?php echo $detail['price']?>"/>元<br />
        库存：<input type="number" name="stock"  value="<?php echo $detail['stock']?>"/><br />
        单位：<input type="text" name="unit" value="<?php echo $detail['unit']?>"/><br />
        进货渠道：<input type="text" name="channel" value="<?php echo $detail['channel']?>"/><br />
        使用方法：<input type="text" name="method" value="<?php echo $detail['method']?>"/><br />
        适用类别：
        <?php foreach($category as $info){
            echo $info['category']?>
            <?php
                $object = explode(',',$detail['object']);
                if(in_array($info['category'],$object)){
                    $flag = "checked";
                }else{
                    $flag = "";
                }
            ?>
        <input type="checkbox" name="object[]" value="<?php echo $info['category']?>" <?php echo $flag?>/>
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
