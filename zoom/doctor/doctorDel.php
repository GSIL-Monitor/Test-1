<?php
require_once '../db.php';
$db = new DB();
if(isset($_GET['id'])){
    $db->execute_dml("delete from doctor where id={$_GET['id']}");
    header("Location:doctorList.php");
}else{
    die('operator forbidden');
}
