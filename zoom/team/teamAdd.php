<?php
require_once '../db.php';
$db = new DB();

$name = isset($_POST['name']) ? $_POST['name'] : '';
$area = isset($_POST['area']) ? $_POST['area'] : '';
// 新增操作
if($name && $area){
    $sql = "insert into team(name,area) values('{$name}','{$area}')";
    $db->execute_dml($sql);
    header("Location:teamList.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加饲养队</title>
</head>
<body>
    <h1>添加饲养队</h1>
    <form method="post">
        名称：<input type="text" name="name"/><br />
        区域：<input type="text" name="area"/><br />
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
        if(form.area.value=='') {
            alert("请输入区域!");
            return false;
        }
        return true;
    }
</script>
