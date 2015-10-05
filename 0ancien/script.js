//-----vérification du formulaire de la page-----
function verification(){
	
	var erreurs=document.getElementsByClassName('avert');
	var valeurs=document.getElementsByClassName('controle');
	var result = true;
	
	for (var i=0; i<valeurs.length-1; i++){
		
		if(valeurs[i].value==""){
			erreurs[i].style.display='inline';
			result=false;
		}
			
		else {
			erreurs[i].style.display='none';
		}
	}
	return result;
}

//-----révélation description-----
function depliement(elem){
	var tailleMin = 50;
	var tailleMax = 440;
	
	if(elem.offsetHeight-10<tailleMin){
		agrandir(elem,tailleMin,tailleMax);
		elem.style.backgroundImage='url("../images/flbamin.png")';
	}
	else{
		retrecir(elem,tailleMin,tailleMax);
		elem.style.backgroundImage='url("../images/fldrmin.png")';
	}
}


function agrandir(elem,tailleMin,tailleMax){
	var tai=elem.offsetHeight;
	tai+=Math.pow(tai/50,2);
	elem.style.height=tai+"px";
	if(tai<tailleMax){
		setTimeout(agrandir,30,elem,tailleMin,tailleMax);
	}
}


function retrecir(elem,tailleMin,tailleMax){
	var tai=elem.offsetHeight;
	tai+=-Math.pow((tai)/50,2);
	elem.style.height=tai+"px";
	if(tai>tailleMin){
		setTimeout(retrecir,30,elem,tailleMin,tailleMax);
	}
}
//-----fin révélation description-----

//-----Carrousel-----
var roll=document.getElementById("roll");
var stop = false;

roll.onmouseover = function(){
	stop=true;
}

roll.onmouseout = function(){
	stop=false;
}

function slide(tableau,a,sens){
	
	var article=tableau.parentNode;
	var ligne=tableau.children[0];
	
	if(sens==1 & !stop){
		if(tableau.offsetLeft+ligne.offsetWidth+10>article.offsetWidth ){
			a --;
			tableau.style.left = a+'px';
			setTimeout(slide,100,tableau, a,sens);
		}
		else{
			sens--;
			setTimeout(slide,500,tableau, a,sens);
		}
	}
	else if(sens==0 & !stop){
		if(tableau.offsetLeft+10<0){
			a ++;
			tableau.style.left = a+'px';
			setTimeout(slide,100,tableau, a,sens);
		}
		else{
			sens++;
			setTimeout(slide,500,tableau, a,sens);
		}
	}
	else{
		setTimeout(slide,500,tableau, a,sens);
	}
}

slide(roll, 0,1);
//-----fin carrousel-----

//-----diaporama-----
function change(elem,position){
	var ligne = elem.parentNode.childNodes;
	var image=ligne[2].firstChild;
	var nom=image.name.split(',');
	var dossier = image.getAttribute('dossier');
	position %= nom.length-1;
	position = (position < 0? -position : position);
	image.src="../bases/albums/"+dossier+"/"+nom[position]+'.png';
	image.alt=nom[position];
}

var gauche=document.getElementById('fleche_gauche');
var droite=document.getElementById('fleche_droite');
var image=document.getElementById('image_principale');
var position = 0;


if(image){
change(image,position);

gauche.onclick = function(){
	position--;
	change(image,position);
}

droite.onclick = function(){
	position++;
	change(image,position);
}

}
//-----fin diaporama-----
