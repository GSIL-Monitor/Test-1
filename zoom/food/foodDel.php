<?php
require_once '../db.php';
$db = new DB();
if(isset($_GET['id'])){
    $db->execute_dml("delete from food where id={$_GET['id']}");
    header("Location:foodList.php");
}else{
    die('operator forbidden');
}
