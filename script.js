jQuery(document).ready(function($) {
   
});


function updateText(video_url) {
   var ajax = new XMLHttpRequest();
   ajax.onreadystatechange = function() {
      if (this.readyState == 3) {
         var old_value = document.getElementById("result").innerHTML; 
         document.getElementById("result").innerHTML = this.responseText;
      }               
   };          
   var url = 'ajax.php?video_url='+video_url;
   ajax.open('GET', url,true);
   ajax.send();
}
document.getElementById("download").onclick = function(){
video_url = document.getElementById("video_url").value;
   updateText(video_url);
}