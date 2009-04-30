<?php
error_reporting(0);
include('stream2.inc.php');
$servid=$_GET['id'];
$server=$servers[$servid];
$link = $server['serv'].":";
$s_link = str_replace("::", ":", $link);
list($addr,$port)= explode (':',"$s_link");
if (empty($port)){
        $port = 80;
}

$addr = server($addr);

if ($server['udp'] == 'TRUE')
	$addr = "udp://" . $addr;
	
//print($addr);

//Test the server connection
$churl = @fsockopen($addr, $port, $errno, $errstr, 5);

             if (!$churl){
                         //echo $errstr;
               //header("Location: $dead");
		echo "<font color=red>Offline</font>";
                }
             else {
                  //header("Location: $live");
		echo "<font color=green onmouseover=\"ajax_showTooltip('stream/moviepic.php?id=$servid',this);return false\" onmouseout=\"ajax_hideTooltip()\">Online</font>";
                  }
function server($addr){
         if(strstr($addr,"/")){$addr = substr($addr, 0, strpos($addr, "/"));}
         return $addr;
}

?>