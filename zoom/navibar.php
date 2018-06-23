<a href="../animal/animalList.php">动物</a>
<a href="../animal/feedLog.php">动物喂养记录</a>
<a href="../animal/healthLog.php">动物治疗记录</a>
<a href="../doctor/doctorList.php">兽医</a>
<a href="../feeder/feederList.php">饲养员</a>
<a href="../team/teamList.php">饲养队</a>
<a href="../food/foodList.php">饲料</a>
<a href="../species/speciesList.php">物种</a>

<?php
$db = new DB();
$sql = "select count(*) total from message where flag='否'";
$res = $db->get($sql);
?>
<a href="../message/index.php">消息（<?php echo $res['total']?>）</a>
