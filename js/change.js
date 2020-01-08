function codeToPrix (prixDefault ,row){
var sel = document.getElementById("TypeEchange");
var opt = sel.options[sel.selectedIndex];
	  if(opt.value == "vente"){

prix =  document.getElementsByName("prix")[row].value =  prixDefault;
  }
  else {prix = document.getElementsByName("prix")[row].value = (1/prixDefault).toFixed(3) ;
}


if(document.getElementsByName("montant")[row].value  != 0)
changeUpadte(document.getElementsByName("montant")[row].value,prix,row ,0);


}
function typeEchange(type,row){
	var sel = document.getElementById("my_select");

var opt = sel.options[sel.selectedIndex];

	 if(type == "vente"){
prix=document.getElementsByName("prix")[row].value =  opt.value ;
  }else{
prix=document.getElementsByName("prix")[row].value =  (1/opt.value).toFixed(3) ;

  }
 montant= document.getElementsByName("montant")[row].value;
changeUpadte(montant , prix,row);
	return prix;
}

function submitValue (){
      var sel = document.getElementById("my_select");

      var opt = sel.options[sel.selectedIndex];
      var para = document.createElement("INPUT");
      para.setAttribute("type", "hidden");
      para.setAttribute("value", opt.id);
      para.setAttribute("name", "id");

      var form = document.getElementById("idTaux");
      form.appendChild(para);
      document.getElementById("formAdd").submit();


}

function changeUpadte(montant ,prix,row) {
  var montant_ml = prix * montant;
  document.getElementsByName("montant-ml")[row].value = montant_ml.toFixed(3);

}
function changeAdd(montant) {
  var montant_ml = document.getElementsByName("prix")[0].value * montant;
  montant_ml.toFixed(3);
  document.getElementById("montant_ml").value = montant_ml;
}
function  annule() {
    document.getElementById('commit').style.display = "none";
}

function  valider() {
    document.getElementById('commit').style.display = "flex";
}



function  showList(num, id,e,j) {
    className=j+'list';
    if(id == "false"){
        document.getElementsByClassName(className)[0].style.display = "flow-root";
e.id = "true";

    }else {

        document.getElementsByClassName(className)[0].style.display = "none";
        e.id = "false";

    }
}
