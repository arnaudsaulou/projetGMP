
//Ajouter un item séléctionné et paramétré à la page de création (énoncé)
function ajouterParametres() {
	//Simulation d'une variable globale

	if( typeof numParams == 'undefined' ) { numParams = 1; }
	numParams++;
	
	//Récupérer les éléments de l'ihm nécessaire
	var enteteTableau = document.getElementById("enteteTableau");
	var piedTableau = document.getElementById("piedTableau");
	
	var newParamsEntete = document.createElement('th');
	newParamsEntete.appendChild(document.createTextNode("Paramètre " + numParams));
	enteteTableau.appendChild(newParamsEntete);
	
	var newParamsPied = document.createElement('th');
	newParamsPied.appendChild(document.createTextNode("Paramètre " + numParams));
	piedTableau.appendChild(newParamsPied);
	
	ajouterNouveauParams();

}

//Appel du fichier AJAX afin d'ajouter une nouvelle collonne de paramètre
function ajouterNouveauParams(){
	$.post("./ajax/ajoutPamametresCorrection.ajax.php",  function(data) {
      console.log(data); 
    });
}
