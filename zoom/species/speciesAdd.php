<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加物种</title>
</head>
<body>
    <h1>添加物种</h1>
    <form  method="post">
        名称：<input type="text" name="name"/><br />
        寿命：<input type="number" name="lifetime"/><br />
        保护级别：<input type="number" name="protection_level"/><br />
        习性：<input type="text" name="habit"/><br />
        栖息地：<input type="text" name="habitat"/><br />
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
<?php
require_once '../db.php';
$db = new DB();
$name = isset($_POST['name']) ? $_POST['name'] : '';
$lifetime = isset($_POST['lifetime']) ? $_POST['lifetime'] : '';
$protection_level = isset($_POST['protection_level']) ? $_POST['protection_level'] : '';
$habit = isset($_POST['habit']) ? $_POST['habit'] : '';
$habitat = isset($_POST['habitat']) ? $_POST['habitat'] : '';
// 新增操作
if($name && $lifetime && $protection_level && $habitat && $habit){
    $sql = "insert into species(name,lifetime,protection_level,habitat,habit) values('{$name}','{$lifetime}','{$protection_level}','{$habitat}','{$habit}')";
    $db->execute_dml($sql);
    header("Location:speciesList.php");
}