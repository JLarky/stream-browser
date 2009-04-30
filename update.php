<?php
$servers=unserialize(file_get_contents("db/serverlist.db"));
$id=intval($_POST['id']);
if ($servers[$id]) {
$servers[$id]['desc']=$_POST['desc'];
file_put_contents("db/serverlist.db", serialize($servers));
die("Спасибо за участие");
} else {
die("Фигня какая-то");
}
?>