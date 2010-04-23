<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Трансляции локальной сети</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/updateinfo.js"></script>
</head>

<body>
<div id="tooltip" style="position: absolute;display:none"></div>
<div id="header"><img alt="" src="stuff/shout.gif"/>&nbsp;Трансляции</div>
<h4>Если знаете еще сервера, пишите в личку в DC.</h4>
<p>Для просмотра картинки трансляции подведите мышку к слову <span class="online">Online</span>.</p>
<p>Вы можете поменять описание трансляции. Для этого наведите мышкой на описание и кликните edit</p>
<table>
<tr>
	<th>Состояние</th>
	<th>Адрес</th>
	<th>Держатель сервиса</th>
	<th>Ретрансляция</th>
	<th>Что транслирует</th> 

</tr>
<?php
require_once("utils.php");

$servers=servers_get();
//var_dump($servers);

foreach($servers as $i => $server) {
?>
<tr class="tr<?=($i & 1)?>" id="id<?=$i?>">
 <td><span id="stream<?=$i?>" class="indicator"></span></td>
<?
 foreach (filds_get() as $key => $editable) {
  print_td($i, $key, htmlspecialchars($server[$key]),$editable);
 }
?>
</tr>

<?
}
?>
</table>

<p style="text-align:center;padding-top:1em;">
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Strict"/></a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="Valid CSS!" /></a>
<br />
<a href="http://github.com/JLarky/stream-browser/tree/master">view source</a>

</p>


<div id="edit-hint">edit</div>

</body>
</html>
