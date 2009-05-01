$(document).ready(function() {

	$(".edit").mouseenter(function(e){
		span=$(e.currentTarget);
		if ($("input").is("input")) {return false;};
		id=span.parent().parent().attr('id').substring(2);
		$("#edit-hint").remove().appendTo(e.currentTarget);
		//$('<div id="edit-hint">edit</div>').
		offset=span.offset();
		$("#edit-hint").css({'left': offset.left+10,'top':offset.top,
			    'display':"block",'opacity':"1",'background':"white",
			    'padding-left':"3px",'padding-right':"3px"});
		$("#edit-hint").click(function() {
			$("#edit-hint").css('display',"none").remove().appendTo("body");
			val=$("<p/>").text(span.text()).html();
			span.html('<input value="'+val+'" />').find("input").blur(function() {
				id=$(this).parent().attr('id');
				val=$(this).attr('value');
				update_val(id, val);
				val=$("<p/>").text(val).html();
				span.html(val)
			    });
		    })
		    }).mouseleave(function() {
			    $("#edit-hint").fadeOut(0)
				});
	$(".indicator").mouseover(function(i) {showtooltip(i)}).mouseout(function(i) {hidetooltip(i)});
	
	$(".indicator").each(function() {
		id=$(this).attr('id').substring(6)
		    url='stream/status2.php?id='+id;
		$(this).html('<img src="stuff/loading.gif"> Загрузка').load(url)
		    })
	    })
    
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

function updateInfo(Id)
{
$("#infobox"+Id).css({'display':"block"}).find("a").text($("#editbox"+Id).css({'display':"none"}).find("input").attr('value'));

bodyContent = $.ajax({
      url: "update.php",
      global: false,
      type: "POST",
      data: ({desc: document.getElementById('stext'+Id).value, id: Id}),
      dataType: "html",
      success: function(msg){
         alert(msg);
      }
   }
);
}

function update_val(Id, Val)
{
    $.ajax({
	    url: "test.php",
		global: false,
		type: "POST",
		data: ({val: Val, id: Id}),
		dataType: "html",
		success: function(msg){
		alert(msg);
	    }
	});
}