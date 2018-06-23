<?php
require_once '../db.php';
$db = new DB();

$name = isset($_POST['name']) ? $_POST['name'] : '';
$lifetime = isset($_POST['lifetime']) ? $_POST['lifetime'] : '';
$protection_level = isset($_POST['protection_level']) ? $_POST['protection_level'] : '';
$habit = isset($_POST['habit']) ? $_POST['habit'] : '';
$habitat = isset($_POST['habitat']) ? $_POST['habitat'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : 0;
// 修改操作
if($name && $lifetime &&  $protection_level && $habitat && $habit && $id){
    $sql = "update species set name='{$name}',lifetime='{$lifetime}',protection_level='{$protection_level}',habitat='{$habitat}',habit='{$habit}' where id={$id}";
    $db->execute_dml($sql);
    header("Location:speciesList.php");
}

// 获取物种信息
if(isset($_GET['id'])){
    $sql = "select * from species where id={$_GET['id']}";
    $info = $db->get($sql);
    if(count($info) == 0)die("id is not exist");
}else{
    die("operator forbiden");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>修改物种</title>
</head>
<body>
    <h1>修改物种</h1>
    <form  method="post">
        <input type="hidden" name="id"  value="<?php echo $info['id']?>" >
        名称：<input type="text" name="name" value="<?php echo $info['name']?>" /><br />
        寿命：<input type="number" name="lifetime"  value="<?php echo $info['lifetime']?>" /><br />
        保护级别：<input type="number" name="protection_level"  value="<?php echo $info['protection_level']?>" /><br />
        习性：<input type="text" name="habit"  value="<?php echo $info['habit']?>" /><br />
        栖息地：<input type="text" name="habitat"  value="<?php echo $info['habitat']?>" /><br />
        <button type="submit" onclick="return check(this.form)">保存</button>
    </form>
</body>
</html>
<script type="text/javascript">
    function check(form) {
        if(form.name.value=='') {
            alert("请输入物种名!");
            return false;
        }
        if(form.lifetime.value==''){
            alert("请输入寿命!");
            return false;
        }
        if(form.protection_level.value==''){
            alert("请输入保护级别!");
            return false;
        }
        if(form.habit.value==''){
            alert("请输入习性!");
            return false;
        }
        if(form.habitat.value==''){
            alert("请输入栖息地!");
            return false;
        }
        return true;
    }
</script>
