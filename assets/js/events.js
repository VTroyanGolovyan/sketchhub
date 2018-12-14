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
        for (let i = list.length-1; i >= 0; i--){
          var a = document.createElement('a');
          let words = '';
          if (list[i].type == 1)
            words = ' оценил(а) ваш пост';
          else if (list[i].type == 2)
            words = 'прокоментировал(а) ваш пост';
          else if (list[i].type == 3)
            words = ' подписался(ась) на ваши обновления';
          if (list[i].type == 1)
            a.setAttribute('href','?view=post&id='+list[i].object+'&evt='+list[i].evt_id);
          else if (list[i].type == 2)
            a.setAttribute('href','?view=post&id='+list[i].object+'&evt='+list[i].evt_id);
          else if (list[i].type == 3)
            a.setAttribute('href','?view=profile&id='+list[i].u_id+'&evt='+list[i].evt_id);

          a.innerHTML = list[i].name+' ' + list[i].last_name + words;
          container.appendChild(a);
        }
      }

    }
      xhr.open('GET','./ajax/get_events.php',true);
    xhr.send();
  }
}
