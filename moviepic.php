<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');

error_reporting(E_ALL);

$servers=unserialize(file_get_contents("db/serverlist.db"));
$servid=intval($_GET['id']);
$server=$servers[$servid];
$link=$server['url'];
$dontpic=$server['dontpic'];
if ($dontpic != "TRUE") {

$last_line = exec('mplayer -vo jpeg:outdir=/var/www/stream/stream/im'.$servid.' -nocache -quiet -nosound -frames 50 '.$link, $retval);

}
else {
echo "Radio    ;)<br><br><br>";
}
echo "<img src=\"stream/im".$servid."/00000050.jpg\" width=\"170\" height=\"120\" alt=\"\" border=\"0\">\n";

?>