<?php

require_once 'module.php';

class jeux extends module {
	
	var $identification=TRUE;
	var $modulemanager;
	var $core;
	var $message;
	var $actions_module = array(	"Jouer"=>"jouer",
									"Voir les scores"=>"scores"
									);
	function jeux(&$refmm,&$refcore)
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
		
	}
	
	function corps()
	{
		if(isset($_GET['id']))
		{
			$jeu=$this->core->db->selection('jeux','id',$_GET['id'],'',0);
			$record=$this->core->db->selection('score','jeu',$_GET['id'],'score DESC',0);
			if(!empty($record['id_user']) && $jeu['concours']==1) 
			{
				$recordman=$this->core->db->selection('utilisateurs','id',$record['id_user'],'',0);
				$phrase="<p>Record : ".$record['score']." détenu par ".$recordman['login']."</p>";
			}
			elseif($jeu['concours']==1) $phrase="<p>Il n'y a pas encore de record pour ce jeu, tentes ta chance !</p>"; 
			else $phrase="<p>Ce jeu ne fait pas partie du concours, inutile d'enregistrer ton score !</p>"; 
			while($buff=$this->core->db->selection('jeux','id',$_GET['id']))
			{
				echo $phrase;
?>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="556" height="410">
         <param name="movie" value="games/<?php echo $buff['fichier'] ?>.swf"/>

                        <param name="type" value="application/x-shockwave-flash" />
                        <param name="pluginspage" value="http://www.macromedia.com/go/getfla<br />shplayer/" />
                        <param name="menu" value="false" />
                        <param name="FlashVars" value="gamesessid=&gid=<?php echo $_GET['id'] ?>" />
         <embed src="games/<?php echo $buff['fichier'] ?>.swf" menu="false" type="application/x-shockwave-flash" FlashVars="gamesessid=&gid=<?php echo $_GET['id'] ?>" width="556" height="410" pluginspage="http://www.macromedia.com/go/getflashplayer">
         </embed>
      </object>		

<?php	  
			}
		}
		elseif(isset($_GET['action']) && $_GET['action']=="scores")
		{
			$j=1;
			while($buff=$this->core->db->selection('jeux','','','fichier'))
			{
				if($buff['concours']==1)
				{
					echo "\n<table class=\"score left\">";
					echo "\n<tr><th colspan=\"3\">".$buff['nom']."</th></tr>";
					echo "\n<tr><td><strong>Rang</strong></td>";
					echo "\n<td><strong>Pseudo</strong></td>";
					echo "\n<td><strong>Score</strong></td></tr>";
					$query="SELECT * FROM score join utilisateurs where jeu=".$buff['id']." AND score.id_user=utilisateurs.id ORDER by score DESC";//utilisateurs.id=reservation.id_user and id_team=".$buff['id']."";
					$res=mysql_query($query);
					$i=1;
					$rang=0;
					$nombre=mysql_affected_rows();
					while($resultat=mysql_fetch_array($res))
					{
						if($i<=10)
						{
							echo "<tr><td>".$i."</td><td>".$resultat['login']."</td><td>".$resultat['score']."</td></tr>";
						}
						if ($resultat['login']==$_SESSION['identifiant'] && $rang==0) $rang=$i;
						$i++;
					}
					if($rang != 0) $classement=$rang."/".$nombre;
					else $classement="Non classé";
					echo "<tr><td colspan=\"3\">Rang : $classement</td></tr>";
					echo "<tr><td colspan=\"3\"><a href=\"?menu=bonus&module=jeux&id=".$buff['id']."\">Jouer !</a></td></tr>";
					echo "\n</table>";
					if ($j%3==0) echo "<hr />";
					$j++;
				}
			}
		}
		elseif (isset($_GET['action']) && $_GET['action']=="concours")
		{
			while($buff=$this->core->db->selection('jeux','concours',1,'fichier'))
			{
				echo "\n<a href=\"?menu=bonus&module=jeux&id=".$buff['id']."\"><img class=\"left\" src=\"games/".$buff['fichier'].".gif\"/></a>";
				echo "\n<strong>".$buff['nom']."</strong>";
				echo "\n<br />";
				echo "\n<br />";
				echo $buff['description'];
				echo "\n<hr />";
			}
		}
		elseif (isset($_GET['action']) && $_GET['action']=="fun")
		{
			while($buff=$this->core->db->selection('jeux','concours',0,'fichier'))
			{
				echo "\n<a href=\"?menu=bonus&module=jeux&id=".$buff['id']."\"<img class=\"left\" src=\"games/".$buff['fichier'].".gif\"/></a>";
				echo "\n<strong>".$buff['nom']."</strong>";
				echo "\n<br />";
				echo "\n<br />";
				echo $buff['description'];
				echo "\n<hr />";
			}
		}
		else
		{
			echo "\n<p>Si tu as un peu de temps à tuer ou si le yetisport n'a plus de secret pour toi tu tombes à pic ! 
					Entraînes toi dans la section <a href=\"?menu=bonus&module=jeux&action=fun\">Just for fun</a> et quand 
					tu seras prêt(e) viens défier les meilleur(e)s dans notre
					<a href=\"?menu=bonus&module=jeux&action=concours\">concours !</a></p>";
			echo "<p>(seuls les jeux de la section concours enregistreront ton score.)</p>";
		}
	}
	function pied()
	{
	}
}