<?php
require_once '../db.php';
$db = new DB();
if(isset($_GET['id'])){
    $db->execute_dml("delete from team where id={$_GET['id']}");
    header("Location:teamList.php");
}else{
    die('operator forbidden');
}
