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
<div id="header"><a href="http://jlarky.punklan.net/stream/">Трансляции локальной сети</a></div>


<table id="content">

<tr class="sh">
	<td colspan="4">Прямые трансляции</td>
</tr>
<?php
require_once("utils.php");
$servers=servers_get();

if (isset($_REQUEST['url'])) {
  $url=$_REQUEST['url'];
  $retrans=$_REQUEST['retrans'];
  $retrans=($retrans=="yes") ? "Да" : "Нет";
  $new=new_server();
  $new['url']=$url;$new['retrans']=$retrans;
  $servers[]=$new;
  servers_set($servers);
  echo "<br> Сервер был добавлен";
}


function name_sort($s1, $s2) {
   if ($s1['owner'] == $s2['owner']) {return 0;}
   return ($s1['owner']>$s2['owner']) ? 1 : -1;
};
function filter_retr($val) {return $val['retrans'] === "Да";};
function filter_direct($val) {return $val['retrans'] !== "Да";};

foreach($servers as $i => $server) {$servers[$i]['id']=$i;};
//sort
usort($servers, "name_sort");
$retr=array_filter($servers, "filter_retr");
$direc=array_filter($servers, "filter_direct");
$servers=array_merge($direc,$retr);
//end sort
unset($prev);$j=0;
foreach($servers as $server) {
$j++;
$i=$server['id'];
// раздел между транляцией и ретрансляцией
if (isset($prev) && $server['retrans']!=$prev) {
?>
<tr class="sh">
	<td colspan="4">Ретрансляции</td>
</tr>
<?
};
$prev=$server['retrans'];
?>
<tr class="tr<?=($j & 1)?>" id="id<?=$i?>">
 <td class="status"><span id="stream<?=$i?>" class="indicator"></span></td>
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

<div style="text-align:center;padding-top:1em;margin-bottom:30px;">
<p>Для просмотра картинки трансляции подведите мышку к слову <span class="online">Online</span>.</p>
<p>Вы можете поменять описание трансляции. Для этого наведите мышкой на описание и кликните edit</p>
    <a href="http://validator.w3.org/check?uri=referer">
    <img style="border:0;width:88px;height:31px"
        src="stuff/xhtml.png"
        alt="Valid XHTML 1.0 Strict"/></a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="stuff/css.png"
        alt="Valid CSS!" /></a>
<br />
<a href="http://github.com/JLarky/stream-browser/tree/master">view source</a>
<?php
if (is_admin()) {
?>
<br />
<div style="margin-top:2em;">
<form name="input" action="." method="post">
URL: <input type="text" name="url" />
Retrans: <input type="checkbox" name="retrans" value="yes" />
<input type="submit" value="Добавить" />
</form>
</div>
<?php
}
?>
</div>


<div id="footer">Если знаете других трансляторов --- свяжитесь с <a href="http://wiki.punklan.net/p:JLarky">JLarky</a>.</div>

<div id="edit-hint">edit</div>

</body>
</html>
