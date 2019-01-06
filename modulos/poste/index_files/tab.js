<!-- funzioni javascript
function TabMenu(id_menu, tab_id, azione) {
  var valore = document.getElementById(id_menu + "voce");
  var voce = document.getElementById('div_' + valore.value);
  var old_voce = "cont_" + valore.value;
  var new_voce = "cont_" + tab_id;
  voce.id = "div_" + tab_id;
  valore.value = tab_id;
  var old_content = document.getElementById(old_voce);
  var new_content = document.getElementById(new_voce);
  new_content.style.display = 'block';
  if (old_voce != new_voce) {
    old_content.style.display = 'none';
  }
  if (azione) {
    var param = "id_nodo:"+id_menu +"_inner;parent:" + new_voce + ";position:static";
    var s = azione.split("?");
    azione = s[0];
    var query_string = s[1];
    callA(azione,query_string,param)
  }
//-->
}
