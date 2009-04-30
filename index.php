<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Трансляции локальной сети</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/updateinfo.js"></script>
</head>

<body>
<div id="tooltip" style="position: absolute;display:none"></div>
<div id="header"><img alt="" src="stuff/shout.gif"/>&nbsp;Трансляции</div>
<h4>Если знаете еще сервера, пишите в личку в DC.</h4>Для просмотра картинки трансляции подведите мышку к слову <span style="color:#008000">Online</span>.<br /><br />
<em>Новая функция:</em> описание трансляций. Уважаемый пользователь, есть просьба править описания по мере необходимости. Это несложно: нажмите на текущее описание, введите новый текст и щелкните "Обновить".

<br /><br />
<table>
<tr>
	<th>Состояние</th>
	<th>Адрес</th>
	<th>Держатель сервиса</th>
	<th>Ретрансляция</th>
	<th>Что транслирует</th> 

</tr>
<?php
$servers=unserialize(file_get_contents("db/serverlist.db"));

foreach($servers as $i => $server)
{
?>
<tr class="tr<?=($i & 1)?>" id ="id<?=$id?>">
  <td>
    <span id="stream<?=$i?>" class="indicator"></span>
  </td>
  <td class="url"><a href="<?=$server['url']?>"><?=$server['url']?></a></td>
  <td class="owner"><?=$server['owner']?></td>
  <td><?=(htmlspecialchars($server['retrans']))?></td>
  <?
    
    $trans = ($server['desc'] ? $server['desc'] : "Нет описания");
    
    print('<td class="desc edit"><div id="infobox'.$i.'"><a class="slabel" onclick="document.getElementById(\'infobox'.$i.'\').style.display=\'none\';document.getElementById(\'editbox'.$i.'\').style.display=\'block\';return false;">'.$trans.'</a></div><div id="editbox'.$i.'" style="display:none;"><input type="text" value="'.$trans.'" id="stext'.$i.'" /><a onclick="updateInfo(\''.$i.'\')">Обновить</a></div></td>');
    
    print("</tr>\n\n");
}
?>
</table>
<br>
</div>

<div style="text-align:center">
<a href="http://github.com/JLarky/stream-browser/tree/master">view source</a>
</div>

</body>
</html>
