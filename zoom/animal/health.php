<?php
require_once '../db.php';
$db = new DB();
header("Content-type: text/html; charset=utf-8");
// 动物信息
$sql = "select * from animal where id={$_GET['id']}";
$animal = $db->get($sql);

// 兽医信息
$sql = "select * from doctor";
$doctorList = $db->execute_dql($sql);

$doctor_id = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : '';
$animal_id = isset($_POST['animal_id']) ? $_POST['animal_id'] : '';
$remark = isset($_POST['remark']) ? $_POST['remark'] : '';
$new = isset($_POST['new']) ? $_POST['new'] : '';

// 新增操作
if($doctor_id && $animal_id && $new){
    $time = date("Y-m-d H:i:s");
    $old = $db->get("select health from animal where id='{$animal_id}'")['health'];
    $sql = "update animal set health='{$new}' where id='{$animal_id}'";
    $db->execute_dml($sql);
    $sql = "insert into health_log(animal_id,doctor_id,old,new,record_time,remark) values('{$animal_id}','{$doctor_id}','{$old}','{$new}','{$time}','{$remark}')";
    $db->execute_dml($sql);
    header("Location:healthLog.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>治疗动物</title>
</head>
<body>
    <h1>治疗动物</h1>
    <form method="post">
        动物名称：<?php echo $animal['nickname']?> <br />
        <input type="hidden" name="animal_id" value="<?php echo $_GET['id']?>" />
        兽医：<select name="doctor_id">
            <option value="">--请选择--</option>
            <?php foreach($doctorList as $doctor){?>
            <option value="<?php echo $doctor['id']?>"><?php echo $doctor['name']?></option>
            <?php }?>
        </select><br />
        治疗后：<select name="new">
            <option value="">--请选择--</option>
            <option value="良好健康">良好健康</option>
            <option value="一般健康">一般健康</option>
            <option value="轻微疾病">轻微疾病</option>
            <option value="中度疾病">中度疾病</option>
            <option value="重度疾病">重度疾病</option>
        </select><br />
        备注：<input type="text" name="remark"/><br />
        <button type="submit" onclick="return check(this.form)">保存</button>
    </form>
</body>
</html>
<script type="text/javascript">
    function check(form) {
        if(form.food_id.value==''){
            alert("请选择兽医!");
            return false;
        }
        if(form.new.value=='') {
            alert("请选择治疗后状态!");
            return false;
        }
        return true;
    }
</script>
