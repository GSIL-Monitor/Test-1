<?php
require_once '../db.php';
$db = new DB();
if(isset($_GET['id'])){
    $db->execute_dml("delete from feeder where id={$_GET['id']}");
    header("Location:feederList.php");
}else{
    die('operator forbidden');
}
