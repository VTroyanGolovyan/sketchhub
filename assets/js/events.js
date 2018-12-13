function getEvents(){

  if (!document.getElementById('event-box').checked){
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
      if (this.readyState == 1){
        document.getElementById('event-list').innerHTML="Загрузка...";
      }else if (this.readyState == 4){
        let list = JSON.parse(xhr.responseText);
        let container = document.getElementById('event-list');
        document.getElementById('event-list').innerHTML="";
        if (list.length == 0)
          document.getElementById('event-list').innerHTML="<a>Ничего нового</a>";
        for (let i = list.length-1; i > 0; i--){
          var a = document.createElement('a');
          a.innerHTML = list[i].name+' ' + list[i].last_name + ' оценил(а) ваш пост';
          container.appendChild(a);
        }
      }

    }
      xhr.open('GET','./ajax/get_events.php',true);
    xhr.send();
  }
}
