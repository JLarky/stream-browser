function updateInfo(serv, elemId)
{
	str = document.getElementById(elemId).value.replace("\b", "%20");
	url = 'update.php?server='+serv+"&status="+str;

	new Ajax.Request(url, {method: 'get'});
}
