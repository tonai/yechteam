<?php

require_once 'module.php';

class inscription extends module {
	var $modulemanager;
	var $core;
	var $message;

	function inscription(&$refmm,&$refcore)
	{
		$this->modulemanager=&$refmm;
		$this->core=&$refcore;
		$this->erreur="";
		
	}
	
	function action()
	{
		if (isset($_GET['action']) && $_GET['action']=='verif')
		{
			$buff=$this->core->db->selection('utilisateurs','login',$_POST['ins_login'],'',0);
			$ip=$this->core->utile->getip();
			$accept=0;
			if (!$this->core->formulaire->fullpost(array('prenom','nom','ins_login','ins_mdp','confmdp','mail')))
			{
				$this->message="Certains champs ne sont pas remplis !";
			}	
			elseif(isset($buff)) $this->message="Ce login existe déjà !";	
			elseif(!preg_match('#^[a-z A-Z 0-9 ._-]+@[a-z 0-9 ._-]{2,}\.[a-z]{2,4}$#',$_POST['mail'])) $this->message="Le mail n'est pas valide !";
			elseif($_POST['ins_mdp']!=$_POST['confmdp']) $this->message="Les mots de passe ne correspondent pas !";
			else 
			{
				$this->core->db->ajout('utilisateurs',array('prenom','nom','login','mdp','mail','ip'),array($_POST['prenom'],$_POST['nom'],$_POST['ins_login'],md5($_POST['ins_mdp']),$_POST['mail'],$ip));
				
				$this->core->utile->redirection('?module=inscription&action=valid');
			}
		}
	
	}
	
	function en_tete()
	{
		echo "\t<title>Site Icelsius</title>\n";
	}
	
	function corps()
	{
		if (isset($_GET['action']) && $_GET['action']=='valid')
		{
			echo "<p>Tu es maintenant inscrit !!!</p>";
		}
		else
		{
			echo "<p>En t'inscrivant tu pourras participer à toutes nos activités mais aussi découvrir notre section bonus !
	</p><br />";
			echo $this->message."<br /><br />";
			if(isset($_POST['prenom'])) $prenom=$_POST['prenom'];
			else $prenom="";
			if(isset($_POST['nom'])) $nom=$_POST['nom'];
			else $nom="";
			if(isset($_POST['ins_login'])) $login=$_POST['ins_login'];
			else $login="";
			if(isset($_POST['mail'])) $mail=$_POST['mail'];
			else $mail="";
	
?>

	<form method="POST" action="?module=inscription&action=verif">
		<label for="prenom">Prénom : </label>
			<input type="text" id="prenom" name="prenom" value="<?php echo $prenom;  ?>" /><br /><br />	
		<label for="nom">Nom : </label>
			<input type="text" id="nom" name="nom" value="<?php echo $nom;  ?>" /><br /><br />	
		<label for="inscription_login">Login : </label>
			<input type="text" id="inscription_login" name="ins_login" value="<?php echo $login;  ?>" /><br /><br />	
		<label for="inscription_mdp">Mot de passe : </label>
			<input type="password" id="inscription_mdp" name="ins_mdp"><br /><br />
		<label for="inscription_confmdp">Confirmation : </label>
			<input type="password" id="inscription_confmdp" name="confmdp"><br /><br />
		<label for="inscription_mail">Mail : </label>
			<input type="text" id="inscription_mail" name="mail" value="<?php echo $mail; ?>"><br /><br />
		<hr />
		<input type="submit" value="valider" />
	</form>

<?php
		}
	}
	
	function pied()
	{
	}
}