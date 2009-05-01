<?php
require_once("utils.php");

$servers=servers_get();
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
	
$churl = @fsockopen($addr, $port, $errno, $errstr, 5);

             if (!$churl){
		echo '<span class="offline">Offline</font>';
                }
             else {
		echo '<span class="online">Online</font>';
                  }
function server($addr){
         if(strstr($addr,"/")){$addr = substr($addr, 0, strpos($addr, "/"));}
         return $addr;
}

?>