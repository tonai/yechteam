<?php

require_once 'module.php';

class calendrier extends module {
	
	var $modulemanager;
	var $core;
	var $message;
	var $actions_module = array(	"Toutes nos activités"=>"activites",
														"Nos affiches"=>"affiches"
													);
	function calendrier (&$refmm,&$refcore)
	{
		$this->modulemanager=&$refmm;
		$this->core=&$refcore;
		$this->erreur="";
	}
	
	function action()
	{
	}
	
	function en_tete()
	{
		echo "\t<title>Site Icelsius</title>\n";
	}
	
	function corps()
	{
		if (isset($_POST['semaine'])) $num_semaine=$_POST['semaine'];
		elseif (isset ($_GET['action']) && $_GET['action']=='activites' || !isset($_GET['action'])) $num_semaine=date('W');
		if (isset($num_semaine))
		{
			echo "<p>Voici le calendrier des évènements organisés cette semaine. Prends bien note !</p><br />	";
		switch ($num_semaine)
		{
		case 11:

?>
	<table class="calendrier">
		<tr>
			<th></th>
			<th>Vendredi<br />16 Mars</th>
			<th>Samedi<br />17 Mars</th>
			<th>Dimanche<br />18 Mars</th>
		</tr>
		<tr>
			<td class="titre_ligne">Matin</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td class="rempli"><a href="?menu=evenements&module=reservation&date_ev=0318">Petit déj</a></td>
		</tr>
		<tr>
			<td class="titre_ligne">Aprèm</td>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<td class="titre_ligne">Soir</td>
			<td class="rempli"><a href="#">Repas tartiflette<br />glaces</td>
		</tr>
	</table>
	
<?php
	
		break;
		case 12:

?>

	<table class="calendrier">
		<tr>
			<th></th>
			<th>Lundi<br />19 Mars</th>
			<th>Mardi<br />20 Mars</th>
			<th>Mercredi<br />21 Mars</th>
			<th>Jeudi<br />22 Mars</th>
			<th>Vendredi<br />23 Mars</th>
			<th>Samedi<br />24 Mars</th>
			<th>Dimanche<br />25 Mars</th>
		</tr>
		<tr>
			<td class="titre_ligne">Matin</td>
			<td></td>
			<td class="rempli">Petit déj à <br />Centrale</td>
			<td rowspan="3"></td>
			<td></td>
			<td class="rempli">Petit déj à <br />Centrale</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
		</tr>
		<tr>
			<td class="titre_ligne">Aprèm</td>
			<td class="rempli">Gouter à <br />Centrale</td>
			<td rowspan="2"></td>
			<td class="rempli"><a href="?menu=evenements&module=reservation&date_ev=0322">Lasergame</a></td>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<td class="titre_ligne">Soir</td>
			<td></td>
			<td></td>
			<td class="rempli"><!--<a href="?menu=evenements&module=reservation&date_ev=0324">-->Torcho solidarité<br />Sidaction</td>
		</tr>
	</table>
	
<?php
		break;
		case 13:

?>
<table class="calendrier">
		<tr>
			<th></th>
			<th>Lundi<br />26 Mars</th>
			<th>Mardi<br />27 Mars</th>
			<th>Mercredi<br />28 Mars</th>
			<th>Jeudi<br />29 Mars</th>
			<th>Vendredi<br />30 Mars</th>
			<th>Samedi<br />31 Mars</th>
			<th>Dimanche<br />01 Avril</th>
		</tr>
		<tr>
			<td class="titre_ligne">Matin</td>
			<td rowspan="3"></td>
			<td class="rempli">Petit déj</td>
			<td></td>
			<td class="rempli">Petit déj</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td></td>
		</tr>
		<tr>
			<td class="titre_ligne">Aprèm</td>
			<td rowspan="2"></td>
			<td class="rempli">Gouter</td>
			<td rowspan="2"></td>
			<td class="rempli">Poisson d'avril !</td>
		</tr>
		<tr>
			<td class="titre_ligne">Soir</td>
			<td></td>
			<td class="rempli">Repas torche</td>
			<td></td>
		</tr>
	</table>

<?php

		break;
		case 14:

?>

	<table class="calendrier">
		<tr>
			<th></td>
			<th>Lundi<br />02 Avril</th>
			<th>Mardi<br />03 Avril</th>
			<th>Mercredi<br />04 Avril</th>
			<th>Jeudi<br />05 Avril</th>
			<th>Vendredi<br />06 Avril</th>
			<th>Samedi<br />07 Avril</th>
			<th>Dimanche<br />08 Avril</th>
		</tr>
		<tr>
			<td class="titre_ligne">Matin</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td rowspan="3" class="rempli"><string>1er tour</strong></td>
			<td rowspan="2"></td>
			<td></td>
			<td rowspan="3"></td>
			<td rowspan="3"></td>
		</tr>
		<tr>
			<td class="titre_ligne">Aprèm</td>
			<td class="rempli">Gouter</td>
		</tr>
		<tr>
			<td class="titre_ligne">Soir</td>
			<td class="rempli">Torchot</td>
			<td class="rempli">Soirée orientale</td>
			<td></td>
		</tr>
		</table>

<?php

		break;
		case 15 :
		
?>			
	<table class="calendrier">
		<tr>
			<th></th>
			<th>Lundi<br />09 Avril</th>
			<th>Mardi<br />10 Avril</th>
			<th>Mercredi<br />11 Avril</th>
		</tr>
		<tr>
			<td class="titre_ligne">Matin</td>
			<td rowspan="3"></td>
			<td rowspan="3" class="rempli"><strong>Débat des prez</strong></td>
			<td rowspan="3" class="rempli"><strong>2ème tour</strong></td>
		</tr>
		<tr>
			<td class="titre_ligne">Aprèm</td>
		</tr>
		<tr>
			<td class="titre_ligne">Soir</td>
		</tr>
	</table>

<?php

		default:
		break;
			
		}
		
?>	

		<br />
		<br />
		<form method="POST" action="?menu=evenements&module=calendrier">
			<p>Voir une autre semaine : </p>
			<select name="semaine">
				<option value="11" <?php if($num_semaine==11) echo "selected=\"selected\"";?>>Semaine 1 (du 11/03 au 18/03)</option>
				<option value="12" <?php if($num_semaine==12) echo "selected=\"selected\"";?>>Semaine 2 (du 19/03 au 25/03)</option>
				<option value="13" <?php if($num_semaine==13) echo "selected=\"selected\"";?>>Semaine 3 (du 26/03 au 01/04)</option>
				<option value="14" <?php if($num_semaine==14) echo "selected=\"selected\"";?>>Semaine 4 (du 02/04 au 08/04)</option>
				<option value="15" <?php if($num_semaine==15) echo "selected=\"selected\"";?>>Semaine 5 (du 09/04 au 15/04)</option>
			</select>
			<input type="submit" value="valider" />
		</form>
		
<?php		

	
		}
	elseif ($_GET['action']=='affiches') echo "<p>Ici tu retrouveras toutes nos affiches au fur et à  mesure que la campagne avance !</p>";	
	}
	function pied()
	{
	}
}