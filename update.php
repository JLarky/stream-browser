<?php
$file = file_get_contents('channels.txt');

$lines = split("\n", $file);

$host = getenv('remote_addr');

//if (eregi($host, $_GET['server']))
//{
	$flag = 0;
	for ($i = 0; $i < count($lines); $i++)
		if (eregi($_GET['server'], $lines[$i]))
		{
			$lines[$i] = $_GET['server'] . "\t" . stripslashes($_GET['status']);
			$flag = 1;
		}

	if ($flag == 0)
		$lines[count($lines)] = $_GET['server'] . "\t" . stripslashes($_GET['status']);
//}

$file = join("\n", $lines);

file_put_contents('channels.txt', $file);
?>
