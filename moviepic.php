<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');

error_reporting(E_ALL);
require_once("utils.php");

$servers=servers_get();
$servid=intval($_GET['id']);
$server=$servers[$servid];
$link=$server['url'];
$dontpic=$server['dontpic'];
if ($dontpic != "TRUE") {

$dir=dirname($_SERVER["SCRIPT_FILENAME"])."/tmp/im".$servid;

$last_line = exec('mplayer -vo jpeg:outdir="'.$dir.'" -nocache -quiet -nosound -frames 50 '.$link, $retval);

}
else {
echo "Radio    ;)<br><br><br>";
}
echo "<img src=\"tmp/im".$servid."/00000050.jpg\" width=\"170\" height=\"120\" alt=\"\" border=\"0\">\n";

?>