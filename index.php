<?php
include('stream/stream2.inc.php');

?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Трансляции локальной сети</title>
	<script src="js/ajax-dynamic-content.js">
	</script>
	<script src="js/ajax.js">
	</script>
	<script src="js/ajax-tooltip.js">
	</script>
	<script src="js/prototype.js">
	</script>
	<script src="js/updateinfo.js">
	</script>
</head>

<body>
<div class="sresults">
<div border="0" style="width:100%;border-bottom:1px solid black;margin-bottom:2pt;padding-bottom:2pt"><img alt="" src="stuff/shout.gif"/>&nbsp;<b>Трансляции </b><br></div>
<h4>Если знаете еще сервера, пишите в личку в DC.</h4>Для просмотра картинки трансляции подведите мышку к слову <span style="color:#008000">Online</span>.<br /><br />
<em>Новая функция:</em> описание трансляций. Уважаемый пользователь, есть просьба править описания по мере необходимости. Это несложно: нажмите на текущее описание, введите новый текст и щелкните "Обновить".
<br /><br />

<?php
$i=0;

$host = getenv("remote_addr");
//print($host);

print("<table style=\"text-align:center;width:100%;\">
<tr>
	<th>Состояние</th>
	<th>Адрес</th>
	<th>Держатель сервиса</th>
	<th>Ретрансляция</th>
	<th>Что транслирует</th> 
</tr>
");

$ctx = array();

$ctxstring = file_get_contents('channels.txt');

$ctxarray = split("\n", $ctxstring);

for ($j = 0; $j < count($ctxarray); $j++)
{
	$srv = split("\t",$ctxarray[$j]);
	$ctx[$srv[0]] = $srv[1];
}

$keys = array_keys($ctx);

//print_r($ctx);

foreach($servers as $server)
{
	$i++;
	print('<tr>
		<td>
			<span id="stream'.$i.'"></span>
			<SCRIPT type="text/javascript">ajax_loadContent(\'stream'.$i.'\',\'stream/status2.php?id='.$i.'\')</SCRIPT>
		</td>
		<td><a href="'.$server['url'].'">'.$server['url'].'</a></td>
		<td>'.$server['owner'].'</td>
		<td>'.htmlspecialchars($server['retrans']).'</td>
		');

	$trans = "Нет описания";

	for ($j = 0; $j < count($ctx); $j++)
		if ($server['serv'] == $keys[$j])
			$trans = htmlspecialchars($ctx[$keys[$j]]);

	$ip = split(":",$server['serv']);
	$ip = $ip[0];

		print('<td><div id="infobox'.$i.'"><a style="text-decoration:underline;" onclick="document.getElementById(\'infobox'.$i.'\').style.display=\'none\';document.getElementById(\'editbox'.$i.'\').style.display=\'block\';return false;">'.$trans.'</a></div><div id="editbox'.$i.'" style="display:none;"><input type="text" value="'.$trans.'" id="stext'.$i.'" /><a href="" onclick="updateInfo(\''.$server['serv'].'\', \'stext'.$i.'\')">Обновить</a></div></td>');

	print('</tr>');
}
print("</table>");
?>
<br>
</div>

<div style="text-align:center">
Примечание от JLarky: если вам интересно как плохо написана эта страничка и вам охото её переписать, напишите мне в DC или jlarky@gmail.com
</div>

</body>
</html>
