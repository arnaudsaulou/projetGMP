$(document).ready(function() {

	var btnNumX;

  //Gestion si click
  $('.btnAdParams').click(function(event){
			idBtn = event.target.id;
			idBtn = idBtn.substr(11,1);
			ajouterParametres(idBtn);
	});

});
//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterParametres(idBtn) {

	//Récupérer les éléments de l'ihm nécessaire
	var paramSection = document.getElementById("paramSection"+idBtn);

	var newParam = document.createElement('select');
	newParam.id = idBtn;
	paramSection.appendChild(newParam);

	var array = ajouterNouveauParams();

	for (var i = 0; i < array.length; i++) {
	    var option = document.createElement("option");
	    option.value = array[i];
	    option.text = array[i];
	    newParam.appendChild(option);
	}

}

//Appel du fichier AJAX afin d'ajouter une nouvelle collonne de paramètre
function ajouterNouveauParams(){
	$.post("./ajax/ajoutPamametresCorrection.ajax.php",  function(data) {
		console.log(data);
		return data;
	});
}
