<?php
require_once("utils.php");

$servers=servers_get();
$allowedkeys=filds_get();
$id=explode("-",$_POST['id']);
$key=$id[0];$id=intval($id[1]);
if ($servers[$id] and $allowedkeys[$key]) {
$val=$_POST['val'];
if ($key=="url" && isset($val) && $val=="") {
  unset($servers[$id]);
  servers_set($servers);
  die("Сервер был удалён");
} else {
  $servers[$id][$key]=mb_substr($val,0,70, 'UTF-8');
  servers_set($servers);
  die("Спасибо за участие");
}
} else {
die("Фигня какая-то");
}
?>