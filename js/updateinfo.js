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
