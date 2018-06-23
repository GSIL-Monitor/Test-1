<?php
require_once '../db.php';
$db = new DB();

$name = isset($_POST['name']) ? $_POST['name'] : '';
$area = isset($_POST['area']) ? $_POST['area'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

// 修改操作
if($name && $area && $id){
    $sql = "update team set name='{$name}',area='{$area}' where id={$id}";
    $db->execute_dml($sql);
    header("Location:teamList.php");
}

// 获取饲养队信息
if(isset($_GET['id'])){
    $sql = "select * from team where id={$_GET['id']}";
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
    <title>修改饲养队信息</title>
</head>
<body>
    <h1>修改饲养队信息</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $info['id'];?>" />
        名称：<input type="text" name="name" value="<?php echo $info['name']?>" /><br />
        区域：<input type="text" name="area" value="<?php echo $info['area']?>" /><br />
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
