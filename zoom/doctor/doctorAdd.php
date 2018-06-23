<?php
require_once '../db.php';
$db = new DB();

$name = isset($_POST['name']) ? $_POST['name'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$work_years = isset($_POST['work_years']) ? $_POST['work_years'] : '';
$area = isset($_POST['area']) ? $_POST['area'] : '';
// 新增操作
if($name && $area && $age && $work_years){
    $sql = "insert into doctor(name,area,work_years,age) values('{$name}','{$area}','{$work_years}','{$age}')";
    $db->execute_dml($sql);
    header("Location:doctorList.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加兽医</title>
</head>
<body>
    <h1>添加兽医</h1>
    <form method="post">
        姓名：<input type="text" name="name"/><br />
        年龄：<input type="number" name="age"/><br />
        工龄：<input type="number" name="work_years"/><br />
        区域：<input type="text" name="area"/><br />
        <button type="submit" onclick="return check(this.form)">保存</button>
    </form>
</body>
</html>
<script type="text/javascript">
    function check(form) {
        if(form.name.value=='') {
            alert("请输入姓名!");
            return false;
        }
        if(form.age.value=='') {
            alert("请输入年龄!");
            return false;
        }
        if(form.work_years.value=='') {
            alert("请输入工龄!");
            return false;
        }
        if(form.area.value=='') {
            alert("请输入区域!");
            return false;
        }
        return true;
    }
</script>
