var old_product = [];

function editButton(button) {
    button.style.display = "none";
    button.nextSibling.nextSibling.style.display = "none";
    var confirm = button.nextSibling.nextSibling.nextSibling.nextSibling;
    var reset = button.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling;
    reset.style.display = "block";
    confirm.style.display = "block";
  var row = button.closest("tr");
  var children = row.children;
  for(var i=0; i<children.length - 1; i++){
            var child = children[i];
            old_product[i] = child.children[0].value;
            child.children[0].disabled = false;
            child.children[0].style.pointerEvents = "auto";
        }
}
function confirmButton(button){
    old_productName = old_product[0];
    old_description = old_product[1];
    old_price = old_product[2].substring(1);
    var category = button.closest("table").children[1].id;
    var tr = button.closest("tr");
    var newProduct = [];
    for(i=0;i<3;i++){
        newProduct[i] = tr.children[i].children[0].value;
    }
    if(old_productName != newProduct[0] || old_description != newProduct[1] || old_price != newProduct[2].substring(1)){
        //da cambiare
        window.location.href = "/admin-page.php?edit=true&category="+category+"&old_name="+ old_productName+"&old_descr="+old_description+"&old_price="+old_price + "&new_name="+newProduct[0] + "&new_descr="+newProduct[1]+"&new_price="+newProduct[2].substring(1);
    }else{
        window.location.reload();
    }
    console.log(newProduct[0]);
}
function deleteButton(Bottone) {
		    var prev = Bottone.parentNode.parentNode.parentNode;
		    var product =  prev.children[0].children[0].value;
		    var category = prev.parentNode.parentNode.children[1].id;
		    let isDelete = confirm("Sei sicuro di voler cancellare: " + product );
		  if(isDelete == true){
            window.location.href = "/admin-page.php?delete="+product+"&category="+category;
      }
           }


		$(document).ready(function() {
			// Attiva o disattiva il toggle della tabella quando viene cliccato l'header
			$(".toggle-header").click(function() {
				$(this).next(".toggle-body").slideToggle();
			});
		});
		
function addRecord(tableName){
    var category = tableName[0].id;
    var name_product = window.prompt("Inserisci il nome del prodotto:");
    if(name_product != null && name_product != ""){
    var descrizione = window.prompt("Inserisci la descrizione");
    if(descrizione != null){
        var prezzo = parseFloat(window.prompt("Inserisci il prezzo")).toFixed(2);
        if(prezzo != null && prezzo > 0){
            window.location.href = "/admin-page.php?add="+true+"&category="+category+"&name="+name_product+"&descr="+descrizione+"&price="+prezzo;
        }else{
            return;
        }
    }else{
        return;
    }
    }else{
        return;
    }
    
    
}