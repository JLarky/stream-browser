<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Трансляции локальной сети</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/updateinfo.js"></script>
	<style type="text/css">.online{color:green}.offline{color:red}</style>
<script>
function showtooltip(i) {
 span=$(i.currentTarget);
 if (span.find("span").hasClass('online')) {
 id=span.attr('id').substring(6)
 offset=span.offset();
 $("#tooltip").css({'display': "block", 'left': offset.left+60, 'top': offset.top+5}).html('<img src="stuff/loading.gif"> Загрузка').load('moviepic.php?id='+id)
 }
}
function hidetooltip(i) {
 $("#tooltip").css({'display': "none"})
}
$(document).ready(
 function() {
  $(".indicator").mouseover(function(i) {showtooltip(i)}).mouseout(function(i) {hidetooltip(i)});

  $(".indicator").each(function() {
  id=$(this).attr('id').substring(6)
  url='stream/status2.php?id='+id;
  $(this).html('<img src="stuff/loading.gif"> Загрузка').load(url)
 })
})
</script>
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
	print('<tr class="tr'.($i & 1).'">
		<td>
			<span id="stream'.$i.'" class="indicator"></span>
		</td>
		<td class="url"><a href="'.$server['url'].'">'.$server['url'].'</a></td>
		<td class="owner">'.$server['owner'].'</td>
		<td>'.htmlspecialchars($server['retrans']).'</td>
		');

	$trans = ($server['desc'] ? $server['desc'] : "Нет описания");

	print('<td class="desc"><div id="infobox'.$i.'"><a class="slabel" onclick="document.getElementById(\'infobox'.$i.'\').style.display=\'none\';document.getElementById(\'editbox'.$i.'\').style.display=\'block\';return false;">'.$trans.'</a></div><div id="editbox'.$i.'" style="display:none;"><input type="text" value="'.$trans.'" id="stext'.$i.'" /><a onclick="updateInfo(\''.$i.'\')">Обновить</a></div></td>');

	print("</tr>\n\n");
}
print("</table>");
?>
<br>
</div>

<div style="text-align:center">
<a href="http://github.com/JLarky/stream-browser/tree/master">view source</a>
</div>

</body>
</html>
