<?php
require_once("utils.php");

$servers=servers_get();
$servid=$_GET['id'];
$server=$servers[$servid];
list($t, $link)=explode ('//',$server['url']);
list($addr,$port)= explode (':',"$link");
//var_dump($addr,$port);

if (empty($port)){
        $port = 80;
}

$addr = server($addr);

if ($server['udp'] == 'TRUE')
	$addr = "udp://" . $addr;

//var_dump($addr, $port, $errno, $errstr, 5);	
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