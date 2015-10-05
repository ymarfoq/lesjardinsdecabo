
var semaines, datein, dateout, month, prix,  debut
semaines=document.getElementsByTagName('td');
datein = document.getElementById('datein');
dateout = document.getElementById('dateout');

var sem= new Array();


var i=0;
while(semaines[i]){
	if(semaines[i].innerHTML.indexOf("Semaine")>0 & semaines[i].innerHTML.indexOf("Semaine")<10){
			sem.push(semaines[i]);
		}
	i++;
}

function change_date(i){
	sem[i].onclick=function(){
		var dateinch = document.createTextNode(sem[i].getAttribute('debut'));
		var dateoutch = document.createTextNode(sem[i].getAttribute('fin'));
		var prixaffiche = document.getElementById('prixaffiche');
		var prixenvoie = document.getElementById('prixenvoie');
		var newprix = document.createTextNode(sem[i].getAttribute('prix'))
		var form = document.getElementById('dates');
		var reservation = document.getElementById('reservation');
		var resa_complet = document.getElementById('resa_complet');
		var nom =document.getElementById('nom');
			if(sem[i].getAttribute('etat')=='Disponible'){
				
				reservation.style.display='inline';
				resa_complet.style.display='none';
				nom.focus();
				
				prixaffiche.replaceChild(newprix, prixaffiche.firstChild);
				prixenvoie.value=newprix.nodeValue;
		
				form.firstChild.replaceChild(dateinch, form.firstChild.firstChild);
				form.lastChild.replaceChild(dateoutch, form.lastChild.firstChild);
		
				datein.value=sem[i].getAttribute('debut');
				dateout.value=sem[i].getAttribute('fin');
				
				
			}
			else{
				reservation.style.display='none';
				resa_complet.style.display='inline';
			}
	}
}

for (var i = 0; i < sem.length; i++) {
change_date(i);
}





