var loadBlok=document.createElement('div');
    loadBlok.style.margin='0px 0px 0px 92px';
    loadBlok.background='#FFFFFF none repeat scroll 0%';
    loadBlok.innerHTML='<img src="/stuff/loading.gif" style="position: absolute; margin-left: -25px;">Loading...';
var browsType = {
    IE:     !!(window.attachEvent && !window.opera),
    Opera:  !!window.opera,
    WebKit: navigator.userAgent.indexOf('AppleWebKit/') > -1,
    Gecko:  navigator.userAgent.indexOf('Gecko') > -1 && navigator.userAgent.indexOf('KHTML') == -1,
    MobileSafari: !!navigator.userAgent.match(/Apple.*Mobile.*Safari/)
}
function makeRequest(obj,adres) {
    blok=loadBlok.cloneNode(true);
    obj.parentNode.parentNode.appendChild(blok);
    document.body.style.display='inline';
    document.body.style.display='block';
    var httpRequest;
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
            // See note below about this line
        }
    } 
    else if (window.ActiveXObject) { // IE
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } 
            catch (e) {
                       try {
                            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                           } 
                         catch (e) {}
                      }
                                   }

    if (!httpRequest) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }
    httpRequest.onreadystatechange = function() { alertContents(obj,httpRequest); };
    //httpRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    httpRequest.open('GET', adres, true);
    httpRequest.send('');
}
function alertContents(obj,httpRequest) {

    if (httpRequest.readyState == 4) {
        if (httpRequest.status == 200) {
            xmldoc = httpRequest.responseXML;
            return gonah(obj,xmldoc);
        } else {
            alert('There was a problem with the request.');
        }
    }
}
function gonah(obj,xmldoc){
  countOfFiles=xmldoc.getElementsByTagName('item').length-1;
  main_str='';
  for (ii=0;ii<=countOfFiles; ii++) {
    main_str+='<pre><code>'+xmldoc.getElementsByTagName('item').item(ii).getAttribute('size')+'</code>';
    if (xmldoc.getElementsByTagName('item').item(ii).getAttribute('imgsrc')=='stuff/1.gif')
      main_str+='<div class="square"><span class="square" onclick=\"req(this,\'' + xmldoc.getElementsByTagName('item').item(ii).getAttribute('xmlhref') + '\')\">+</span></div>&nbsp;&nbsp';
    else main_str+='&nbsp;&nbsp;';
    main_str+='<img src=\"' + xmldoc.getElementsByTagName('item').item(ii).getAttribute('imgsrc') +'\" alt=\"\"/>&nbsp;';
    main_str+='<a href=\"' + xmldoc.getElementsByTagName('item').item(ii).getAttribute('href') + '\">';
    main_str+=xmldoc.getElementsByTagName('item').item(ii).getAttribute('filename') + '</a>';
    main_str+='<a class=\"directlink\" href=\"' + xmldoc.getElementsByTagName('comp')[0].getAttribute('dir')+ xmldoc.getElementsByTagName('item').item(ii).getAttribute('filename')  + '\">&rarr;</a></pre>';
  }
  blok=document.createElement('div');
  blok.style.margin='0px 0px 0px 10px'
  blok.setAttribute("class","branch");
  blok.innerHTML=main_str;
  if (obj.parentNode.parentNode.replaceChild(blok,obj.parentNode.parentNode.lastChild)) {document.body.style.display='inline';document.body.style.display='block'};
}

function req(obj,param){
  if (obj.parentNode.parentNode.getElementsByTagName('DIV').length==1){
    makeRequest(obj,'http://'+location.host+"/gena/"+param);
    obj.innerHTML="&#8211;";
  } else {
    var hideobj=obj.parentNode.parentNode.getElementsByTagName('DIV')[1];
    if (hideobj.style.display=='none') {
    hideobj.style.display='block'; obj.innerHTML="&#8211;";
    } else {
    hideobj.style.display='none'; obj.innerHTML="+";
    setTimeout("document.body.style.display='inline';document.body.style.display='block';",100);
    }
    }
}
function getElementsByClassName(className, tag, elm){
var testClass = new RegExp("(^|\\\\s)" + className + "(\\\\s|$)");
var tag = tag || "*";
var elm = elm || document;
var elements = (tag == "*" && elm.all)? elm.all : elm.getElementsByTagName(tag);
var returnElements = [];
var current;
var length = elements.length;
for(var i=0; i<length; i++){
current = elements[i];
if(testClass.test(current.className)){
returnElements.push(current);
}
}
return returnElements;
}
function foldAll(val) {
    var mass1 = getElementsByClassName("square", "div", document.body);
    var mass2 = getElementsByClassName("squareroot", "div", document.body);
    mass = mass1.concat(mass2);
    for (i in mass) {
	var obj=mass[i].getElementsByTagName('SPAN')[0];
	if (obj.innerHTML!="+" && val==0) {
	    obj.parentNode.parentNode.getElementsByTagName('DIV')[1].style.display='none'; obj.innerHTML="+";obj.hid=1;
	}
	if (obj.hid=="1" && val==1) {
	    obj.parentNode.parentNode.getElementsByTagName('DIV')[1].style.display='block'; obj.innerHTML="&#8211;";obj.hid=0;
	}
    }
setTimeout("document.body.style.display='inline';document.body.style.display='block';",50);
}