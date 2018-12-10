function like(id){
  var xhr = new XMLHttpRequest();
  xhr.open('GET','./ajax/like.php?id='+id,true);
  xhr.onreadystatechange = function(){
    if (xhr.readyState == 4){
      document.getElementById('likes-counter-'+id).innerHTML = xhr.responseText;
    }
  }
  xhr.send();
}
