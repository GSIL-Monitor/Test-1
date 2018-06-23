<?php
require_once '../db.php';
$db = new DB();
if(isset($_GET['id'])){
    $db->execute_dml("delete from species where id={$_GET['id']}");
    header("Location:speciesList.php");
}else{
    die('operator forbidden');
}
