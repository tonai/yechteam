<?php

require_once 'module.php';

class equipe extends module {
	
	var $modulemanager;
	var $core;
	var $message;
	var $actions_module = array(	"L'�quipe"=>"presentation",
									"Le programme"=>"programme",
									"Le film de campagne"=>"film",
									);
	function __construct(&$refmm,&$refcore)
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
		<li><a href="?menu=equipe&module=equipe&action=programme&par=integration">Int�gration</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=evenements">Ev�nements et soir�es</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=rez">Vie � la rez</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=communication">Communication</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=solidarite">Solidarit�</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=autres">Autres �coles</a></li>
		<li><a href="?menu=equipe&module=equipe&action=programme&par=ecole">Vie � l'�cole</a></li>
	</ul>
<br />
<div id="intro" class="lseft">La Yech'team soumet ses id�es pour am�liorer la vie du centralien. Toutes ces id�es ne sont que des propositions, nous sommes ouverts � toute remarque ou suggestion pour parfaire notre programme, car avant tout, nous voulons que celui-ci soit repr�sentatif de la plupart d'entre vous.<br />Pour donner ton avis rien de plus simple, loggue toi et �cris ton message dans le paragraphe concern� !
</div>
<hr>
<hr class="normal" />
<br />



<ul class="programme" id="tele">
<p>Celui-l� on est certains que tu le liras tout les soirs !</p>
<br />
<iframe frameborder="0" bordercolor="#FFFFFF" scrolling="no" width="90%" height="1050" src="http://www.kamone.net/webmaster/ptv.php"></iframe>
</ul>
<ul class="programme" id="etudes">
	<li>Veiller � ce que la r�forme de l'enseignement se fasse avec les �l�ves.</li>
	<li>Lib�rer un cr�neau hebdomadaire pour le travail en association.</li>
	<li>G�n�ralisation du serveur p�dagogique � l'ensemble des mati�res.</li>
	<li>Compl�ter la formation du centralien par l'organisation de conf�rences sur des sujets vari�s choisis par les �l�ves.</li>
	<li>Distribution des polys d'annales et de choix des NF directement dans les boites aux lettres.</li>  
	<li>Aider ceux qui le souhaitent � trouver un stage � l'�tranger.</li>
	<li>Etablir des contacts avec des r�sidences universitaires �trang�res pour pouvoir trouver plus facilement un logement � l'�tranger durant le stage obligatoire.</li>
</ul>
<ul class="programme" id="integration">
	<li>S'assurer du maintient d'une commande group�e et diversifi�e pour le mat�riel informatique par le Rezol�o et si besoin les aider � la r�alisation de cette t�che.</li> 
	<li>Faire plus de communication sur les commandes group�es en �lectrom�nagers, et maintenir celles-ci au moins jusqu'au mois de d�cembre.</li>
	<li>Encourager les G1 et les IE3 � s'investir dans les diff�rents clubs, commissions et associations. Pour cela nous voulons que chaque assoce puisse disposer de visibilit� durant l'int�gration.</li>
	<li>Organisation d'un WEI pour tous, pour cr�er un v�ritable esprit d'�cole.</li>
	<li>Soutenir et appliquer le projet TYCHE.</li>
</ul>
<ul class="programme" id="evenements">
	<li>Nous souhaitons faire du foyer le coeur de la rez, pour cela, nous ferons tout pour qu'il n'y ait pas une semaine sans �v�nement au foyer.</li>
	<li>Nous inciterons les centraliens � organiser des repas d'�tage r�guli�rement tout au long de l'ann�e.</li>
	<li>Pour que les centraliens bougent un peu hors de Villeneuve d'Ascq, nous proposerons un planning des diff�rentes soir�es �tudiantes pr�sentes sur Lille et aux alentours.</li>
	<li>En ce qui concerne les voyages, nous voulons en organiser un tous les trimestres.</li>
</ul>
<ul class="programme" id="rez">
<li>Aider ISF � sensibiliser les centraliens au r�chauffement climatique et leur faire adopter un v�ritable comportement responsable vis-�-vis de la plan�te.<br />
<li>Mettre sur notre site un plan d�taill� des adresses � conna�tre comme dentiste, m�decin, poste... et tout ce qui se trouve dans le labyrinthe de triolo. Nous pensions �galement filmer le trajet car une vue en 3D c'est toujours plus fiable qu'un plan en 2D !<br />
<li>Assurer une permanence au DF tous les soirs.</li>
<li>R�aliser un film de pr�sentation de la r�sidence afin que les G1 connaissent les lieux d�s leur arriv�e.</li>
<li>Contribution � la r�alisation du film de pr�sentation de l'�cole.</li>
<li>Veillez � ce que la salle commune du batiment D le reste, quoi qu'il arrive.</li>
<li>Faire un recensement de toutes les salles et de leurs utilisateurs afin de ne pas les perdre inutilement.</li>
</ul>
<ul class="programme" id="communication">
	<li>Inciter les �l�ves � utiliser IRC, qui est le moyen le plus rapide et le plus fiable pour communiquer � un grand nombre de personnes simultan�ment.</li>
	<li>Continuer les r�unions inter-prez des assoces.</li>
	<li>Sensibiliser les centraliens � l'importance du centralSpam et faire en sorte que les G1 arr�tent de polluer inutilement les mod�rateurs par du Spam excessif.</li>
	<li>Continuer le d�veloppement du portail des �l�ves, afin que celui-ci poss�de toujours plus de fonctionnalit�s.</li>
</ul>
<ul class="programme" id="solidarite">
	<li>Inclure dans le cursus du centralien la formation pour l'AFPS, la rendre gratuite.</li>
	<li>Continuer d'organiser des �v�nements lors du t�l�thon.</li>
</ul>
<ul class="programme" id="autres">
	<li>Nous voulons que les relations particuli�res entre les Ecoles Centrales se retrouvent aussi au niveau des �l�ves.C'est pourquoi nous aimerions maintenir une communication entre les diff�rents BDE de celles-ci, afin que les �l�ves sachent ce qu'il se passe dans le groupe Centrale.</li>
	<li>Nous  favoriserons l'organisation d'�v�nements inter-�coles entre associations, commissions ou clubs similaires.</li>
	<li>Nous maintiendrons l'organisation des soir�es en partenariat avec d'autres �coles de la m�tropole lilloise.</li>
</ul>
<ul class="programme" id="ecole">
	<li>Nous souhaitons compl�ter l'offre de journaux gratuits chaque matin en ajoutant, au 20 minutes, les �chos.</li>
	<li>Nous soutiendrons le projet du CRI de passer l'�cole en WIFI.</li>
</ul>

	<?php	

if (isset($_GET['par']) && !empty($_GET['par']) && $this->core->admin->estidentifie())
	{



	echo "<br />";
	echo "<br />";
	echo "<p>Tu veux r�agir sur ce point ?</p>";
	echo "<form method=\"POST\" action =\"?menu=equipe&module=equipe\">";
	echo "<textarea cols=\"40\" rows=\"5\" name=\"message\"></textarea>";
	echo "<input type=\"hidden\" name=\"par\" value=\"".$_GET['par']."\" />";	
	echo "<br /><br />";
	echo "<input type=\"submit\" />";
	echo "</form>";
	echo "<hr />";
	$query="SELECT * FROM commentaires join utilisateurs where utilisateurs.id=commentaires.id_user and paragraphe='".$_GET['par']."'";
	$res=mysqli_query($query);
	while($buff=mysqli_fetch_array($res))
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
			echo "<p>Tu as aim� notre film ou tu ne l'as pas vu en amphi ? Ouvre les yeux !</p><br />";
			echo "
			
			\n<div id=\"lecteur\">
			\n<object type=\"application/x-shockwave-flash\" width=\"384\" height=\"288\" data=\"flvplayer.swf\">
				\n<param name=\"movie\" value=\"flvplayer.swf\" />
				\n<param name=\"flashvars\" value=\"file=film.flv\" />
			\n</object>
			\n</div>";
		
		echo "<br />";
		echo "<a href=\"videos/film_de_campagne.avi\">T�l�charger le film (pour les ext�rieurs)</a>";
		echo "<br />";
		echo "<a href=\"ftp://tuxp.vinci.ec-lille.fr/yechteam/film_de_campagne.avi\">T�l�charger le film (ftp pour la rez)</a>";
		echo "<br />";
		echo "<br />";
		echo "Un probl�me pour voir le film ? Voici un lecteur g�nial : <a href=\"videos/gomplayer.exe\">T�l�charger</a>";
		}
		
		
		
		elseif (isset($_GET['action']) && $_GET['action']=='presentation' || !isset($_GET['action'])) 
		{
		 echo "<h4>Pr�sentation des membres</h4>";
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
			<td>Petit d�j</td>
		</tr>
		<tr>
			<td>Apr�s-midi</td>
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
			<td>Petit d�j</td>
			<td rowspan="3"></td>
			<td></td>
			<td>Petit d�j</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
		</tr>
		<tr>
			<td>Apr�s-midi</td>
			<td>Gouter</td>
			<td rowspan="2"></td>
			<td>Lazer game</td>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<td>Soir</td>
			<td></td>
			<td></td>
			<td>Soir�e karaok�</td>
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
			<td>Petit d�j</td>
			<td></td>
			<td>Petit d�j</td>
			<td rowspan="2"></td>
			<td rowspan="3"></td>
			<td></td>
		</tr>
		<tr>
			<td>Apr�s-midi</td>
			<td rowspan="2"></td>
			<td>Gouter</td>
			<td rowspan="2"></td>
			<td>Aprem d�lire + gouter</td>
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
			<td>Apr�s-midi</td>
			<td>Gouter</td>
		</tr>
		<tr>
			<td>Soir</td>
			<td>Torchot</td>
			<td>Soir�e orientale</td>
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
			<td rowspan="3">D�bat des prez</td>
			<td rowspan="3">2eme tour</td>
		</tr>
		<tr>
			<td>Apr�s-midi</td>
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