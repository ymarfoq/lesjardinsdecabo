<div class="center">
<h2>Calendrier</h2>
<br/>
<table width="100%" cellspacing="10px">
	<tr>
		<td class="euro500 calendrier">500€</td>
		<td class="euro700 calendrier">700€</td>
		<td class="euro800 calendrier">800€</td>
	</tr>
</table>
</br>
<h3>Veuillez choisir votre semaine de vacance dans le calendrier.</h3>

<?php

include("calendrier.php");

$timestampFin = strtotime("01-10-".date("Y"));


if (time()<$timestampFin)
	{$cal = new calendrier(date("Y"));}
else
	{$cal = new calendrier(date("Y")+1);}

if(isset($_GET["reservation"])){
	$cal->getsemaine($_GET["reservation"]+1)->reserver();
	echo $cal->getsemaine($_GET["reservation"]+1)->getetat();
	}

$cal->afficherLecalendrier();

?>

<p class="close">Les semaines sont systématiquement louées de SAMEDI au SAMEDI.
<br/>Si vous souhaitez arriver ou partir un autre jour, veuillez nous contacter.</p>

<script src="../script_resa.js"></script>

</div>
