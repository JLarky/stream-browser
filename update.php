<?php
require_once("utils.php");

$servers=servers_get();
$allowedkeys=filds_get();
$id=explode("-",$_POST['id']);
$key=$id[0];$id=intval($id[1]);
if ($servers[$id] and $allowedkeys[$key]) {
$servers[$id][$key]=$_POST['val'];
servers_set($servers);
die("Спасибо за участие");
} else {
die("Фигня какая-то");
}
?>