<?php
require_once '../db.php';
$db = new DB();

// 获取物种
$sql = "select * from species group by name";
$speciesList = $db->execute_dql($sql);


$number = isset($_POST['number']) ? $_POST['number'] : '';
$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$sex = isset($_POST['sex']) ? $_POST['sex'] : '';
$species_id = isset($_POST['species_id']) ? $_POST['species_id'] : '';
$health = isset($_POST['health']) ? $_POST['health'] : '';
$requirement = isset($_POST['requirement']) ? $_POST['requirement'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
// 新增操作
if($number && $nickname && $age && $species_id && $sex && $health && $requirement && $category){
    $sql = "insert into animal(number,nickname,age,species_id,sex,health,requirement,category) values('{$number}','{$nickname}','{$age}','{$species_id}','{$sex}','{$health}','{$requirement}','{$category}')";
    $db->execute_dml($sql);
    header("Location:animalList.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加动物</title>
</head>
<body>
    <h1>添加动物</h1>
    <form method="post">
        编号：<input type="text" name="number"/><br />
        昵称：<input type="text" name="nickname"/><br />
        年龄：<input type="number" name="age"/><br />
        性别：<input type="text" name="sex"/><br />
        物种：<select name="species_id">
            <option value="">--请选择--</option>
            <?php foreach($speciesList as $species){?>
            <option value="<?php echo $species['id']?>"><?php echo $species['name']?></option>
            <?php }?>
        </select><br />
        健康状况：<select name="health">
            <option value="">--请选择--</option>
            <option value="良好健康">良好健康</option>
            <option value="一般健康">一般健康</option>
            <option value="轻微疾病">轻微疾病</option>
            <option value="中度疾病">中度疾病</option>
            <option value="重度疾病">重度疾病</option>
        </select><br />
        特殊需求：<input type="text" name="requirement"/><br />
        类别：<input type="text" name="category"/><br />
        <button type="submit" onclick="return check(this.form)">保存</button>
    </form>
</body>
</html>
<script type="text/javascript">
    function check(form) {
        if(form.number.value=='') {
            alert("请输入编号!");
            return false;
        }
        if(form.nickname.value==''){
            alert("请输入昵称!");
            return false;
        }
        if(form.age.value==''){
            alert("请输入年龄!");
            return false;
        }
        if(form.sex.value==''){
            alert("请输入性别!");
            return false;
        }
        if(form.species_id.value==''){
            alert("请选择物种!");
            return false;
        }
        if(form.health.value==''){
            alert("请输入健康状况!");
            return false;
        }
        if(form.requirement.value==''){
            alert("请输入特殊需求!");
            return false;
        }
        if(form.category.value==''){
            alert("请输入类别!");
            return false;
        }
        return true;
    }
</script>
