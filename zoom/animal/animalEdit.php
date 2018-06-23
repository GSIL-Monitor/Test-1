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
$id = isset($_POST['id']) ? $_POST['id'] : '';

// 修改操作
if($number && $nickname && $age && $species_id && $sex && $health && $requirement && $category && $id){
    $sql = "update animal set number='{$number}',nickname='{$nickname}',age='{$age}',species_id='{$species_id}',sex='{$sex}',health='{$health}',requirement='{$requirement}',category='{$category}' where id={$id}";
    $db->execute_dml($sql);
    header("Location:animalList.php");
}

// 获取动物信息
if(isset($_GET['id'])){
    $sql = "select * from animal where id={$_GET['id']}";
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
    <title>修改动物信息</title>
</head>
<body>
    <h1>修改动物信息</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $info['id'];?>" />
        编号：<input type="text" name="number" value="<?php echo $info['number'];?>" /><br />
        昵称：<input type="text" name="nickname"  value="<?php echo $info['nickname'];?>" /><br />
        年龄：<input type="number" name="age" value="<?php echo $info['age'];?>" /><br />
        性别：<input type="text" name="sex" value="<?php echo $info['sex'];?>" /><br />
        物种：<select name="species_id">
            <option value="">--请选择--</option>
            <?php foreach($speciesList as $species){?>
            <option value="<?php echo $species['id']?>"   <?php if($info['species_id'] == $species['id'])echo 'selected'?> ><?php echo $species['name']?></option>
            <?php }?>
        </select><br />
        健康状况：<select name="health">
            <option value="">--请选择--</option>
            <option value="良好健康" <?php if($info['health'] == '良好健康')echo 'selected'?>>良好健康</option>
            <option value="一般健康" <?php if($info['health'] == '一般健康')echo 'selected'?>>一般健康</option>
            <option value="轻微疾病" <?php if($info['health'] == '轻微疾病')echo 'selected'?>>轻微疾病</option>
            <option value="中度疾病" <?php if($info['health'] == '中度疾病')echo 'selected'?>>中度疾病</option>
            <option value="重度疾病" <?php if($info['health'] == '重度疾病')echo 'selected'?>>重度疾病</option>
        </select><br />
        特殊需求：<input type="text" name="requirement" value="<?php echo $info['requirement'];?>" /><br />
        类别：<input type="text" name="category" value="<?php echo $info['category'];?>" /><br />
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
        if(form.require.value==''){
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
