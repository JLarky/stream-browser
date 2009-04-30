if(window.opera)
    for (i=0; i<document.links.length; i++)
	    document.links[i].href = document.links[i].href.replace('file:///','smb:');
	    
function selectReplacement(obj) {
	var ul_open = document.createElement('ul');
	var li_open = document.createElement('li');
	ul_open.appendChild(li_open);
	li_open.onclick = function() {
		open_combobox(this);
	};
	ul_open.onmouseover = function() {
		this.style.borderColor = "#000";
	};
	ul_open.onmouseout = function() {
		this.style.borderColor = "#888";
	};
	ul_open.cb = obj;
	ul_open.className = 'selectReplacement';
	li_open.style.display = 'inline';
	ul_open.style.border = "1px solid #888";
		
	var ul = document.createElement('ul');
	ul.className = 'selectReplacement';
	ul.style.display = 'none';
	ul.style.position = 'absolute';
  
	var opts = obj.options;
	var selectedOpt = (!obj.selectedIndex) ? 0 : obj.selectedIndex;
	for (var i=0; i<opts.length; i++) {
		var li = document.createElement('li');
		var txt = document.createTextNode(opts[i].text);
		li.appendChild(txt);
		li.selText = opts[i].text
		li.selIndex = i;
		li.selectID = obj.id;
		li.onclick = function() {
			selectMe(this);
		};
		if (i == selectedOpt) {
			li.className = 'selected';
			var txt = document.createTextNode("» "+opts[i].text);
			li_open.appendChild(txt);
			ul.sel_text = li_open;
		}
		li.onmouseover = function() {
			this.className += ' hover';
		};
		li.onmouseout = function() {
			//this.className = 
			//	this.className.replace(new RegExp(" hover"), '');
			this.className = 
				this.className.replace(' hover', '');
			this.className = 
				this.className.replace('hover', '');
		};
		ul.appendChild(li);
	}
	obj.parentNode.insertBefore(ul,obj);
	obj.parentNode.insertBefore(ul_open,obj);
	
	ul_open.ul = ul;
	ul.ul_open = ul_open;
	obj.className += ' replaced';
	obj.replacement = ul; 
}

function selectMe(obj) {
	var lis = obj.parentNode.getElementsByTagName('li');
	for (var i=0; i<lis.length; i++) {
		if (lis[i] != obj) {
			lis[i].className='';
			lis[i].onclick = function() {
				selectMe(this);
			};
		} else {
			setVal(obj.selectID, obj.selIndex);
			obj.className='selected';
			obj.parentNode.style.display = "none";
			obj.parentNode.sel_text.innerHTML = "» "+obj.innerHTML;	
		}
	}
}


function rec_add(r,ia){
	var kb=0;
	while(r){kb+=r[ia];r=r.offsetParent}
	return kb
}



function open_combobox(obj){
	obj.parentNode.cb.style.display="block";
	obj.parentNode.cb.focus();
	obj.parentNode.cb.onblur = function(){
		document.to_hide = this.replacement;
		setTimeout('document.to_hide.style.display = "none"',200);
	}
	obj.parentNode.ul.style.left = rec_add(obj.parentNode,"offsetLeft")+"px"; 
	obj.parentNode.ul.style.top = rec_add(obj.parentNode,"offsetTop")+"px"; 
	obj.parentNode.ul.style.display = "block";
}

function setVal(objID,val) {
var obj = document.getElementById(objID);
obj.selectedIndex = val;
}
function setForm() {
var s = document.getElementsByTagName('select');
for (var i=0; i<s.length; i++) {
selectReplacement(s[i]);
}
}
var select_js_onload = window.onload;
window.onload = function() {
	(document.all && !window.print) ? null : setForm();
	if(select_js_onload)
		select_js_onload();
};