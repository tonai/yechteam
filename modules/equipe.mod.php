<?php

require_once 'module.php';

class equipe extends module {
	
	var $modulemanager;
	var $core;
	var $message;
	var $actions_module = array(	"L'équipe"=>"presentation",
									"Le programme"=>"programme",
									"Le film de campagne"=>"film",
									);
	function equipe(&$refmm,&$refcore)
	{
		$this->modulemanager=&$refmm;
		$this->core=&$refcore;
		$this->erreur="";
	}
	
	function action()
	{
		if(isset($_POST['message']) && !empty($_POST['message'])) 
		{
			$message=nl2br(htmlspecialchars($_POST['message']));
			$date=date('Y-m-d');
			$this->core->db->ajout('commentaires',array('id_user','date','paragraphe','message'),array($_SESSION['id'],$date,$_POST['par'],$message));
			unset($_POST['message']);
			$this->core->utile->redirection("?menu=equipe&module=equipe&action=programme&par=".$_POST['par']."");
		}
	
	
	
	}
	
	function en_tete()
	{
		echo "\n<style type=\"text/css\">";
		if(isset($_GET['action']) && $_GET['action']=="presentation" || !isset($_GET['action']))
		echo "#corps_global 
		{
			background:#6bd3f5;
			filter:alpha (opacity=100);
			-moz-opacity:1;
			-khtml-opacity: 1;
			-moz-border-radius:10px;
			float:left;
			margin-bottom:10px;
			width:650px;
			height:500px;
		}";
		elseif(isset($_GET['par']))
		{
			echo "	#".$_GET['par']." 
			{
				
				display:block;
			}
				#".$_GET['par']." li 
			{
			list-style-type:disc;
			}
			
			";
		}
		elseif(!isset($_GET['par']))
		{
			echo "	#tele 
			{
				
				display:block;
			}
				#tele li 
			{
			list-style-type:disc;
			}
			
			";
		}
		echo "\n</style>";
	}
	
	function corps()
	{
		
		if(isset($_GET['action']) && $_GET['action']=='programme')
		{
		
?>	

	<ul class="left" id="sommaire">
		<li><a href="?menu=equipe&module=equipe&action=programme&par=etudes">Etudes</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=integration">Intégration</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=evenements">Evènements et soirées</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=rez">Vie à la rez</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=communication">Communication</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=solidarite">Solidarité</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=autres">Autres écoles</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=ecole">Vie à l'école</a></li>
	</ul>
<br />
<div id="intro" class="lseft">La Yech'team soumet ses idées pour améliorer la vie du centralien. Toutes ces idées ne sont que des propositions, nous sommes ouverts à toute remarque ou suggestion pour parfaire notre programme, car avant tout, nous voulons que celui-ci soit représentatif de la plupart d'entre vous.<br />Pour donner ton avis rien de plus simple, loggue toi et écris ton message dans le paragraphe concerné !
</div>
<hr>
<hr class="normal" />
<br />



<ul class="programme" id="tele">
<p>Celui-là on est certains que tu le liras tout les soirs !</p>
<br />
<iframe frameborder="0" bordercolor="#FFFFFF" scrolling="no" width="90%" height="1050" src="http://www.kamone.net/webmaster/ptv.php"></iframe>
</ul>
<ul class="programme" id="etudes">
	<li>Veiller à ce que la réforme de l'enseignement se fasse avec les élèves.</li>
	<li>Libérer un créneau hebdomadaire pour le travail en association.</li>
	<li>Généralisation du serveur pédagogique à l'ensemble des matières.</li>
	<li>Compléter la formation du centralien par l'organisation de conférences sur des sujets variés choisis par les élèves.</li>
	<li>Distribution des polys d'annales et de choix des NF directement dans les boites aux lettres.</li>  
	<li>Aider ceux qui le souhaitent à trouver un stage à l'étranger.</li>
	<li>Etablir des contacts avec des résidences universitaires étrangères pour pouvoir trouver plus facilement un logement à l'étranger durant le stage obligatoire.</li>
</ul>
<ul class="programme" id="integration">
	<li>S'assurer du maintient d'une commande groupée et diversifiée pour le matériel informatique par le Rezoléo et si besoin les aider à la réalisation de cette tâche.</li> 
	<li>Faire plus de communication sur les commandes groupées en électroménagers, et maintenir celles-ci au moins jusqu'au mois de décembre.</li>
	<li>Encourager les G1 et les IE3 à s'investir dans les différents clubs, commissions et associations. Pour cela nous voulons que chaque assoce puisse disposer de visibilité durant l'intégration.</li>
	<li>Organisation d'un WEI pour tous, pour créer un véritable esprit d'école.</li>
	<li>Soutenir et appliquer le projet TYCHE.</li>
</ul>
<ul class="programme" id="evenements">
	<li>Nous souhaitons faire du foyer le coeur de la rez, pour cela, nous ferons tout pour qu'il n'y ait pas une semaine sans évènement au foyer.</li>
	<li>Nous inciterons les centraliens à organiser des repas d'étage régulièrement tout au long de l'année.</li>
	<li>Pour que les centraliens bougent un peu hors de Villeneuve d'Ascq, nous proposerons un planning des différentes soirées étudiantes présentes sur Lille et aux alentours.</li>
	<li>En ce qui concerne les voyages, nous voulons en organiser un tous les trimestres.</li>
</ul>
<ul class="programme" id="rez">
<li>Aider ISF à sensibiliser les centraliens au réchauffement climatique et leur faire adopter un véritable comportement responsable vis-à-vis de la planète.<br />
<li>Mettre sur notre site un plan détaillé des adresses à connaître comme dentiste, médecin, poste... et tout ce qui se trouve dans le labyrinthe de triolo. Nous pensions également filmer le trajet car une vue en 3D c'est toujours plus fiable qu'un plan en 2D !<br />
<li>Assurer une permanence au DF tous les soirs.</li>
<li>Réaliser un film de présentation de la résidence afin que les G1 connaissent les lieux dès leur arrivée.</li>
<li>Contribution à la réalisation du film de présentation de l'école.</li>
<li>Veillez à ce que la salle commune du batiment D le reste, quoi qu'il arrive.</li>
<li>Faire un recensement de toutes les salles et de leurs utilisateurs afin de ne pas les perdre inutilement.</li>
</ul>
<ul class="programme" id="communication">
	<li>Inciter les élèves à utiliser IRC, qui est le moyen le plus rapide et le plus fiable pour communiquer à un grand nombre de personnes simultanément.</li>
	<li>Continuer les réunions inter-prez des assoces.</li>
	<li>Sensibiliser les centraliens à l'importance du centralSpam et faire en sorte que les G1 arrêtent de polluer inutilement les modérateurs par du Spam excessif.</li>
	<li>Continuer le développement du portail des élèves, afin que celui-ci possède toujours plus de fonctionnalités.</li>
</ul>
<ul class="programme" id="solidarite">
	<li>Inclure dans le cursus du centralien la formation pour l'AFPS, la rendre gratuite.</li>
	<li>Continuer d'organiser des évènements lors du téléthon.</li>
</ul>
<ul class="programme" id="autres">
	<li>Nous voulons que les relations particulières entre les Ecoles Centrales se retrouvent aussi au niveau des élèves.C'est pourquoi nous aimerions maintenir une communication entre les différents BDE de celles-ci, afin que les élèves sachent ce qu'il se passe dans le groupe Centrale.</li>
	<li>Nous  favoriserons l'organisation d'évènements inter-écoles entre associations, commissions ou clubs similaires.</li>
	<li>Nous maintiendrons l'organisation des soirées en partenariat avec d'autres écoles de la métropole lilloise.</li>
</ul>
<ul class="programme" id="ecole">
	<li>Nous souhaitons compléter l'offre de journaux gratuits chaque matin en ajoutant, au 20 minutes, les échos.</li>
	<li>Nous soutiendrons le projet du CRI de passer l'école en WIFI.</li>
</ul>

	<?php	

if (isset($_GET['par']) && !empty($_GET['par']) && $this->core->admin->estidentifie())
	{



	echo "<br />";
	echo "<br />";
	echo "<p>Tu veux réagir sur ce point ?</p>";
	echo "<form method=\"POST\" action =\"?menu=equipe&module=equipe\">";
	echo "<textarea cols=\"40\" rows=\"5\" name=\"message\"></textarea>";
	echo "<input type=\"hidden\" name=\"par\" value=\"".$_GET['par']."\" />";	
	echo "<br /><br />";
	echo "<input type=\"submit\" />";
	echo "</form>";
	echo "<hr />";
	$query="SELECT * FROM commentaires join utilisateurs where utilisateurs.id=commentaires.id_user and paragraphe='".$_GET['par']."'";
	$res=mysql_query($query);
	while($buff=mysql_fetch_array($res))
	{
		$date_array=explode("-",$buff['date']);
		$date=$date_array[2]."-".$date_array[1]."-".$date_array[0];
		echo "<br /><br />";
		echo "<strong>".$buff['prenom']." ".$buff['nom']."</strong> le ".$date; 
		echo "<br />";
		echo $buff['message'];
		
	}
	
	}
	
		}
		elseif(isset($_GET['action']) && $_GET['action']=='film')
		{
			echo "<p>Tu as aimé notre film ou tu ne l'as pas vu en amphi ? Ouvre les yeux !</p><br />";
			echo "
			
			\n<div id=\"lecteur\">
			\n<object type=\"application/x-shockwave-flash\" width=\"384\" height=\"288\" data=\"flvplayer.swf\">
				\n<param name=\"movie\" value=\"flvplayer.swf\" />
				\n<param name=\"flashvars\" value=\"file=film.flv\" />
			\n</object>
			\n</div>";
		
		echo "<br />";
		echo "<a href=\"videos/film_de_campagne.avi\">Télécharger le film (pour les extérieurs)</a>";
		echo "<br />";
		echo "<a href=\"ftp://tuxp.vinci.ec-lille.fr/yechteam/film_de_campagne.avi\">Télécharger le film (ftp pour la rez)</a>";
		echo "<br />";
		echo "<br />";
		echo "Un problème pour voir le film ? Voici un lecteur génial : <a href=\"videos/gomplayer.exe\">Télécharger</a>";
		}
		
		
		
		elseif (isset($_GET['action']) && $_GET['action']=='presentation' || !isset($_GET['action'])) 
		{
		 echo "<h4>Présentation des membres</h4>";
		 echo "<img  id=\"affiche_presentation\" src=\"images/affiche_presentation.jpg\" />";
		}
		
		
		
		
		
		if (isset($num_semaine))
		{
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
			<td>Matin</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td>Petit déj</td>
		</tr>
		<tr>
			<td>Après-midi</td>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<td>Soir</td>
			<td>Open</td>
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
			<td>Matin</td>
			<td></td>
			<td>Petit déj</td>
			<td rowspan="3"></td>
			<td></td>
			<td>Petit déj</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
		</tr>
		<tr>
			<td>Après-midi</td>
			<td>Gouter</td>
			<td rowspan="2"></td>
			<td>Lazer game</td>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<td>Soir</td>
			<td></td>
			<td></td>
			<td>Soirée karaoké</td>
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
			<td>Matin</td>
			<td rowspan="3"></td>
			<td>Petit déj</td>
			<td></td>
			<td>Petit déj</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td></td>
		</tr>
		<tr>
			<td>Après-midi</td>
			<td rowspan="2"></td>
			<td>Gouter</td>
			<td rowspan="2"></td>
			<td>Aprem délire + gouter</td>
		</tr>
		<tr>
			<td>Soir</td>
			<td></td>
			<td>Repas torche</td>
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
			<td>Matin</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td rowspan="3">1er tour</td>
			<td rowspan="2"></td>
			<td></td>
			<td rowspan="3"></td>
			<td rowspan="3"></td>
		</tr>
		<tr>
			<td>Après-midi</td>
			<td>Gouter</td>
		</tr>
		<tr>
			<td>Soir</td>
			<td>Torchot</td>
			<td>Soirée orientale</td>
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
			<td><strong></em>Matin</em></strong></td>
			<td rowspan="3"></td>
			<td rowspan="3">Débat des prez</td>
			<td rowspan="3">2eme tour</td>
		</tr>
		<tr>
			<td>Après-midi</td>
		</tr>
		<tr>
			<td>Soir</td>
		</tr>
	</table>

<?php

		default:
		break;
			
		}
		
?>	

		<br />
		<br />
		<form method="POST" action="?menu=equipe&module=equipe">
			<select name="semaine">
				<option value="11">Semaine 1 (du 11/03 au 18/03)</option>
				<option value="12">Semaine 2 (du 19/03 au 25/03)</option>
				<option value="13">Semaine 3 (du 26/03 au 01/04)</option>
				<option value="14">Semaine 4 (du 02/04 au 08/04)</option>
				<option value="15">Semaine 5 (du 09/04 au 15/04)</option>
			</select>
			<input type="submit" value="valider" />
		</form>
		
<?php		
		}
		
	
	
	
	
	?>	
	
	
	<?php
	
	}
	function pied()
	{
	}
}