<?php
require_once '../db.php';
$db = new DB();
if(isset($_GET['id'])){
    $db->execute_dml("delete from animal where id={$_GET['id']}");
    header("Location:animalList.php");
}else{
    die('operator forbidden');
}
