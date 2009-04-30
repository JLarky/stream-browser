<?php
//ini_set('display_errors', 'On');

header('Cache-Control: no-cache');
header('Pragma: no-cache');

error_reporting(E_ALL);

include('stream2.inc.php');
$servid=escapeshellcmd($_GET['id']);
$server=$servers[$servid];
$link=$server['url'];
$dontpic=$server['dontpic'];

if ($dontpic != "TRUE") {

$last_line = exec('mplayer -vo jpeg:outdir=/var/www/stream/stream/im'.$servid.' -nocache -quiet -nosound -frames 50 '.$link, $retval);

}
else {
echo "Radio    ;)<br><br><br>";
}

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
<meta http-equiv=\"pragma\" content=\"no-cache\"/>
<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate, max-age=0\"/>
<meta http-equiv=\"Expires\" content=\"Mon, 26 Jul 1997 05:00:00 GMT\"/>
<img src=\"stream/im".$servid."/00000050.jpg\" width=\"170\" height=\"120\" alt=\"\" border=\"0\">
\n";
?>
