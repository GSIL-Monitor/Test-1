<?php
require_once '../db.php';
$db = new DB();
header("Content-type: text/html; charset=utf-8");
// 动物信息
$sql = "select * from animal where id={$_GET['id']}";
$animal = $db->get($sql);

// 饲养员列表
$sql = "select * from feeder";
$feederList = $db->execute_dql($sql);

// 饲料信息
$sql = "select * from food where object like '%{$animal['category']}%'";
$foodList = $db->execute_dql($sql);

$feeder_id = isset($_POST['feeder_id']) ? $_POST['feeder_id'] : '';
$food_id = isset($_POST['food_id']) ? $_POST['food_id'] : '';
$use_stock = isset($_POST['use_stock']) ? $_POST['use_stock'] : '';
$animal_id = isset($_POST['animal_id']) ? $_POST['animal_id'] : '';
// 新增操作
if($use_stock && $food_id && $feeder_id){
    // 查询剩余库存
    $stock = $db->get("select stock from food where id='{$food_id}'")['stock'];
    if($use_stock > $stock){
        die('投喂量大于剩余库存');
    }
    // 减少剩余库存
    $leftstock = $stock-$use_stock;
    $sql = "update food set stock = '{$leftstock}' where id = '{$food_id}'";
    $db->execute_dml($sql);
    $time = date("Y-m-d H:i:s");
    $sql = "insert into feed_log(animal_id,feeder_id,food_id,use_stock,record_time) values('{$animal_id}','{$feeder_id}','{$food_id}','{$use_stock}','{$time}')";
    $db->execute_dml($sql);
    header("Location:feedLog.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>喂养动物</title>
</head>
<body>
    <h1>喂养动物</h1>
    <form method="post">
        动物名称：<?php echo $animal['nickname']?> <br />
        <input type="hidden" name="animal_id" value="<?php echo $_GET['id']?>" />
        饲养员：<select name="feeder_id">
            <option value="">--请选择--</option>
            <?php foreach($feederList as $feeder){?>
            <option value="<?php echo $feeder['id']?>"><?php echo $feeder['name']?></option>
            <?php }?>
        </select><br />
        饲料：<select name="food_id">
            <option value="">--请选择--</option>
            <?php foreach($foodList as $food){?>
            <option value="<?php echo $food['id']?>"><?php echo $food['name'].'（剩余'.$food['stock'].$food['unit'].'）'?></option>
            <?php }?>
        </select><br />
        投喂量：<input type="text" name="use_stock"/><br />
        <button type="submit" onclick="return check(this.form)">保存</button>
    </form>
</body>
</html>
<script type="text/javascript">
    function check(form) {
        if(form.feeder_id.value==''){
            alert("请选择饲养员!");
            return false;
        }
        if(form.food_id.value=='') {
            alert("请选择饲料!");
            return false;
        }
        if(form.use_stock.value==''){
            alert("请输入投喂量!");
            return false;
        }
        return true;
    }
</script>
