<?php

require_once 'module.php';

class reservation extends module {
	
	var $identification=TRUE;
	var $modulemanager;
	var $limite=0;
	var $core;
	var $message;
	var $actions_module = array(	//"Envie d'un petit déj ?"=>"matin",
														//"Ou de participer à une activité..."=>"aprem",
													//"Avant de t'éclater dans une de nos soirées !"=>"soir",
													//"----------"=>"#",
													"Voir mes inscriptions"=>"voir",
													//"Modifier une inscription"=>"modifier",
													//"Annuler une inscription"=>"annuler"
													);
	function reservation (&$refmm,&$refcore)
	{
		$this->modulemanager=&$refmm;
		$this->core=&$refcore;
		$this->message="";
	}

	function estcomplete($equipe)
	{
		$query="SELECT * FROM lasergame_team where id=".$equipe."";
		$res=mysqli_query($query);
		while($resultat=mysqli_fetch_array($res))
		{	
			$i=0;
			$query="SELECT * FROM reservation WHERE id_team=".$resultat['id']."";
			$res=mysqli_query($query);
			while($resultat2=mysqli_fetch_array($res))
			{
				$i++;
			}
		}
		if ($i>=9) return TRUE;
		else return FALSE;
	}
	
	function action()
	{
		if(isset($_GET['action']))
		{
			if($_GET['action']=="inscription")
			{
				if(isset($_POST['submit']) && $_POST['submit']=="annuler") $this->core->utile->redirection('?menu=evenements&module=calendrier');
				elseif(!empty($_POST['chambre']))
				{
					if(!preg_match('#^[a-f A-F]{1}[0-9]{1,3}[a-b]?$#',$_POST['chambre'])) $this->message="Le num�ro de chambre n'est pas valide !";		
					else 
					{
						if (!isset($_POST['service'])) $_POST['service']=$_POST['service_heure']." h ".$_POST['service_min'];
						if(!isset($_POST['boisson'])) $_POST['boisson']="";
						$this->core->db->ajout('reservation',array('id_user','date','chambre','boisson','service'),array($_SESSION['id'],$_POST['date_ev'],$_POST['chambre'],$_POST['boisson'],$_POST['service']));
						$this->message="L'enregistrement s'est bien effectu� !";
						$this->core->utile->redirection('?menu=evenements&module=reservation');
					}
				}
				elseif($_POST['date']='0322')
				{
					if($_POST['team']==4 || $_POST['team']==1 || $_POST['team']==2 || $_POST['team']==3) $_POST['service']='13 h 30';
					else $_POST['service']='16 h 00';
					$this->core->db->ajout('reservation',array('id_user','date','service','id_team'),array($_SESSION['id'],$_POST['date_ev'],$_POST['service'],$_POST['team']));	
					$this->message="L'enregistrement s'est bien effectu� !";
					$this->core->utile->redirection('?menu=evenements&module=reservation');
				}
				else 
				{
					$this->message="Le num�ro de chambre est manquant !";
				}
			}
			elseif($_GET['action']=="supprimer")
			{
				$buff=$this->core->db->selection('reservation',array('id','id_user'),array($_GET['idreserv'],$_SESSION['id']));
				if(isset($buff)) $this->core->db->suppression('reservation','id',$_GET['idreserv']);
			}
		
	
			
	
	}
	}
	
	function en_tete()
	{
		echo "\t<title>Site Icelsius</title>\n";
	}
	
	function corps()
	{
		if(isset($_GET['date_ev'])) $date_ev=$_GET['date_ev'];
		elseif(isset($_POST['date_ev'])) $date_ev=$_POST['date_ev'];
		if(isset($date_ev))
		{		
			$buff=$this->core->db->selection('evenements','date',$date_ev,'',0);
			if (isset($buff))
			{
				echo "\n<p>Tu as choisi de t'inscrire � l'�v�nement&nbsp;&nbsp;&nbsp;<em>".$buff['nom']."</em></p>";
				echo "\n<br /><br />";
				echo $buff['description'];
				echo "\n<br /><br />";
				echo $this->message."<br /><br />";		
			
				if(date('md')<=$date_ev)
				{			
			
				if ($date_ev!='0324')
				{
			?>
		
				<form method="POST" action="?menu=evenements&module=reservation&action=inscription">
					<label for="prenom">Pr�nom : </label><?php echo $_SESSION['prenom'];  ?><br /><br />	
					<label for="nom">Nom : </label><?php echo $_SESSION['nom'];  ?><br /><br />	

<?php	
				}
					switch($date_ev)
					{
						case '0318':
					
						/*echo "<label for=\"boisson\">Boisson : </label>";
						echo "<select name=\"boisson\" id=\"boisson\">";
						echo "\n<option>Vin blanc</option>";
						echo "\n<option>Jus de raisin</option>";
						echo "\n<option>Jus de pomme</option>";
						echo "\n<option>Jus d'orange</option>";
						echo "\n</select>";
						echo "\n<hr />";
						echo "\n<label for=\"service\">Service : </label>";
						echo "\n<select name=\"service\" id=\"service\">";
						//echo "\n<option>20 h 30</option>";
						//echo "\n<option>21 h 30</option>";	
						//echo "\n<option>22 h 30</option>";
						echo "\n</select>";
					
					<label for="inscription_login">Chambre : </label>
		<input type="text" id="inscription_login" name="chambre" value="<?php if(isset($chambre)) echo $chambre;?>" /><br /><br />*/	
			/*echo "<label for=\"service_heure\">Service </label>";
						echo "<select name=\"service_heure\" id=\"service_heure\">";
						for ($i=12;$i<=13;$i++)
							{	
								echo "\n<option>".str_pad($i,2,0,STR_PAD_LEFT)."</option>";
							}
						echo "\n</select>";
						echo "\n h ";
						echo "<select name=\"service_min\">";
						for ($i=30;$i<=45;$i+=15)
							{	
								echo "\n<option>".str_pad($i,2,0,STR_PAD_LEFT)."</option>";
							}
						echo "\n</select>";*/ 
		
						break;
						case '0322':
						$buff=$this->core->db->selection('reservation',array('id_user','date'),array($_SESSION['id'],'0322'));
						if (empty($buff['id']))
						{
							echo "<label for=\"team\">Equipe : </label>";
							echo "<select name=\"team\">";
							while($buff=$this->core->db->selection('lasergame_team'))
							{
								if(!$this->estcomplete($buff['id'])) echo "<option value=\"".$buff['id']."\">".$buff['nom']."</option>";
							}
							echo "</select>";
							echo "<br />";
							echo "<br />";
							echo "<p class=\"left\">Liste des �quipes&nbsp;&nbsp;&nbsp;</p>";
							echo "<div class=\"left\">";
							echo "\n<p>Premi�re session (13 h 30 au lasergame)</p>";
							$i=0;
							while($buff=$this->core->db->selection('lasergame_team'))
							{
								if ($i==4) echo "\n<br /><p>Deuxi�me session (16 h 00 au lasergame)</p>";
								echo "<select>";
								echo "<option selected=\"selected\">".$buff['nom']."</option>";
								echo "<optgroup label=\"Participants\">";
								$query="SELECT * FROM utilisateurs join reservation where utilisateurs.id=reservation.id_user and id_team=".$buff['id']."";
								$res=mysqli_query($query);
								while($resultat=mysqli_fetch_array($res))
								{
									echo "<option>".$resultat['prenom']." ".$resultat['nom']."</option>";
								}		
								echo "</optgroup>";
								echo "</select>";
								$i++;
							}
							echo "</div>";
							echo "<hr />";
							echo "<br />";
						}
						
						else $this->limite=1;
						break;
						case '0324':
						break;
						default:
						echo "D�sol�, les inscriptions sont termin�es";
						break;
					}
					if ($this->limite==0 && $date_ev!='0324') 
					{
?>
			
			<input type="hidden" name="date_ev" value="<?php echo $date_ev;  ?>"/> 
				<hr />
				<input type="submit" name="submit" value="valider" />
				<input type="submit" name="submit" value="annuler" />
			</form>

<?php		
					}
					elseif($date_ev!='0324') echo "Les inscriptions sont limit�es � une place par personne inscrite sur le site. Pour changer d'�quipe tu dois quitter celle dans laquelle tu es actuellement et en choisir une autre (dans la limite des places disponibles).";
					
				}
				else 
				{
					echo "Cet �v�nement est d�ja pass� !";
				}
			}
			else
			{
				echo "Cet �v�nement n'existe pas !";
			}
		}
		elseif(isset($_GET['action']) && $_GET['action']=='team') 
		{
		
		
		
		
		echo "<form>";
							echo "<p class=\"left\">Liste des �quipes&nbsp;&nbsp;&nbsp;</p>";
							echo "<div class=\"left\">";
							echo "\n<p>Premi�re session (13 h 30 au lasergame)</p>";
							$i=0;
							while($buff=$this->core->db->selection('lasergame_team'))
							{
								if ($i==4) echo "\n<br /><p>Deuxi�me session (16 h 00 au lasergame)</p>";
								echo "<select>";
								echo "<option selected=\"selected\">".$buff['nom']."</option>";
								echo "<optgroup label=\"Participants\">";
								$query="SELECT * FROM utilisateurs join reservation where utilisateurs.id=reservation.id_user and id_team=".$buff['id']."";
								$res=mysqli_query($query);
								while($resultat=mysqli_fetch_array($res))
								{
									echo "<option>".$resultat['prenom']." ".$resultat['nom']."</option>";
								}		
								echo "</optgroup>";
								echo "</select>";
								$i++;
							}
							echo "</div>";
							echo "<hr />";
							echo "<br />";
		
		echo "</form>";
		
		
		
		
		
		
		
		
		
		}
		else
		{
			echo "\n<p>Voici les liste des activit�s auxquelles tu souhaites participer ! </p>";
			echo "\n<table>";
			echo "\n<tr><th>Date</th><th>Ev�nement</th></tr>";
			$buff=$this->core->db->selection('reservation','id_user',$_SESSION['id'],'date',0);
			if(empty($buff['date'])) echo "<tr><tr /><tr><td colspan=\"3\">Tu n'es inscrit(e) � aucune activit� pour le moment.</td></tr>";
			while($buff=$this->core->db->selection('reservation','id_user',$_SESSION['id'],'date'))
			{	
				$query="SELECT * FROM evenements WHERE date=".$buff['date']."";
				$res=mysqli_query($query);
				while($resultat=mysqli_fetch_array($res))
				{
					$date=$buff['date'][2].$buff['date'][3]."/".$buff['date'][0].$buff['date'][1]."/07";
					echo "\n<tr>";
					echo "\n<td>".$date."</td>";
					echo "\n<td>".$resultat['nom']." � ".$buff['service'];
					if(isset($buff['id_team']) && !empty($buff['id_team'])) 
					{
						$query="SELECT * FROM lasergame_team WHERE id=".$buff['id_team']."";
						$res=mysqli_query($query);
						$resultat2=mysqli_fetch_array($res);
						echo " dans l'�quipe ";
						echo "<select>";
						echo "<option selected=\"selected\">".$resultat2['nom']."</option>";
						echo "<optgroup label=\"Equipiers\">";
						$query="SELECT * FROM utilisateurs join reservation where utilisateurs.id=reservation.id_user and id_team=".$buff['id_team']."";
						$res=mysqli_query($query);
						while($resultat3=mysqli_fetch_array($res))
						{
							if ($resultat3['id_user']!=$_SESSION['id']) echo "<option>".$resultat3['prenom']." ".$resultat3['nom']."</option>";
						}
						echo "</optgroup>";
						
						echo "</select>";
					}
					echo "</td>";
					echo "\n<td><a href=\"?menu=evenements&module=reservation&action=supprimer&idreserv=".$buff['id']."\">Annuler</a>";
					echo "<br />";
					echo "\n<a href=\"?menu=evenements&module=reservation&action=team\">Voir les �quipes</a></td>";
					echo "\n</tr>";
				}
			}
			echo "\n</table>";
		}
	}

	function pied()
	{
	}
}