<?php
require_once '../db.php';
$db = new DB();

// 获取饲养队
$sql = "select * from team";
$teamList = $db->execute_dql($sql);

$name = isset($_POST['name']) ? $_POST['name'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$work_years = isset($_POST['work_years']) ? $_POST['work_years'] : '';
$sex = isset($_POST['sex']) ? $_POST['sex'] : '';
$is_captain = isset($_POST['is_captain']) ? $_POST['is_captain'] : '';
$team_id = isset($_POST['team_id']) ? $_POST['team_id'] : '';
// 新增操作
if($name && $age && $work_years && $sex && $is_captain && $team_id){
    // 一队只能有一个队长
    if($is_captain == '是'){
        $sql = "update feeder set is_captain='否' where team_id='{$team_id}'";
        $db->execute_dml($sql);
    }
    $sql = "insert into feeder(name,age,work_years,sex,is_captain,team_id) values('{$name}','{$age}','{$work_years}','{$sex}','{$is_captain}','{$team_id}')";
    $db->execute_dml($sql);
    header("Location:feederList.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加饲养员</title>
</head>
<body>
    <h1>添加饲养队</h1>
    <form method="post">
        姓名：<input type="text" name="name"/><br />
        年龄：<input type="number" name="age"/><br />
        工龄：<input type="number" name="work_years"/><br />
        性别：<input type="radio" name="sex" value="男" />男
        <input type="radio" name="sex" value="女" />女<br />
        是否是队长：<input type="radio" name="is_captain" checked value="否" />否
        <input type="radio" name="is_captain" value="是" />是<br />
        饲养队：<select name="team_id">
            <option value="">--请选择--</option>
            <?php foreach($teamList as $team){?>
            <option value="<?php echo $team['id']?>"><?php echo $team['name']?></option>
            <?php }?>
        </select><br />
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
        if(form.age.value=='') {
            alert("请输入年龄!");
            return false;
        }
        if(form.work_years.value=='') {
            alert("请输入工龄!");
            return false;
        }
        if(form.sex.value=='') {
            alert("请选择性别!");
            return false;
        }
        if(form.is_captain.value=='') {
            alert("请选择队长!");
            return false;
        }
        if(form.team_id.value=='') {
            alert("请选择饲养队!");
            return false;
        }
        return true;
    }
</script>
