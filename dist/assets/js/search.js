function filtrer() {
	var filtre, liste, ligne, cellule, texte ;
	filtre=document.getElementById('search').value.toUpperCase();
	liste=document.getElementById('list');
	ligne=document.getElementsByTagName('td');

	for (let i = 0; i < ligne.length; i++) {
    if(ligne[i].classList.contains("No")){
		cellule=ligne[i];
		if (cellule) {
			texte=cellule.innerText;
			if(texte.toUpperCase().indexOf(filtre)>-1){
				ligne[i].parentElement.style.display="";
			}
			else{
				ligne[i].parentElement.style.display="none";
			}
		}
	}}
}