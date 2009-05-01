<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');

error_reporting(E_ALL);
require_once("utils.php");

$servers=servers_get();
$servid=intval($_GET['id']);
$server=$servers[$servid];
$link=escapeshellarg($server['url']);
$dontpic=$server['dontpic'];
if ($dontpic != "TRUE") {

$dir=dirname($_SERVER["SCRIPT_FILENAME"])."/tmp/im".$servid;

$ctime=@filectime($dir."/00000050.jpg");
if (file_exists($dir."/00000050.jpg") and ((time()-$ctime) < 60)) {
} else {
$last_line = exec('mplayer -vo jpeg:outdir="'.$dir.'" -nocache -quiet -nosound -frames 150 '.$link, $retval);
}
}
else {
echo "Radio    ;)<br><br><br>";
}
if (file_exists($dir."/00000050.jpg")) {
echo "<img src=\"tmp/im".$servid."/00000150.jpg?$ctime\" width=\"170\" height=\"120\" alt=\"\" border=\"0\">\n";
} else {
echo "<span style='background:white'>Или это радио, или у меня нету подходищих кодеков</span>";
}

?>