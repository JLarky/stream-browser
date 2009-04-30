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
