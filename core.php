<?php

require_once "module_manager.php";
require_once "db.php";
require_once "formulaire.php";
require_once "utile.php";
require_once "administration.php";

class noyau 
{
	var $modulemanager;
	var $db;
	var $formulaire;
	var $utile;
	var $erreurlogin;
	var $login;
	var $menugauche;
	var $menu;
	var $module;
	
	function __construct() 
	{	
		$this->style="icelsius";
		$this->formulaire= new formulaire($this);
		$this->utile= new utile($this);
		$this->db= new db($this);
		$this->admin= new administration($this);
		$this->module_manager=new module_manager($this,$this->style);
		$this->erreurlogin='';
		
		/* 
			Redirige vers le menu accueil si la variable GET ne correspond pas � un menu existant
		*/
		if(isset($_GET['menu']))
		{
			// $buff=$this->db->selection('menu','nom',$_GET['menu'],'',0);	
      $buff = [];
			if(isset($buff)) $this->menu=$_GET['menu'];
			else $this->menu="accueil";
		}
		else $this->menu="accueil";
		
		/* 	
			Charge le premier module par d�faut 
			Sinon redirige vers le menu accueil si la variable GET ne correspond pas � un module existant pour le menu choisi
		*/
		if(isset($_GET['module'])) 
		{		
				// $buff=$this->db->selection('menu','nom',$this->menu,'',0);
        $buff = [];
				// $buff2=$this->db->selection('sous_menu',array('id_menu','module'),array($buff['id'],$_GET['module']),'',0);
        $buff2 = [];
				if(isset($buff2) || $_GET['module']=="inscription") $this->module=$_GET['module'];
				else 
				{
					$this->menu="accueil";
					$this->module="accueil";
				}
		}
		else 
		{
			// $buff=$this->db->selection('menu','nom',$this->menu,'',0);
      $buff = [];
			// $buff2=$this->db->selection('sous_menu','id_menu',$buff['id'],'ordre',0);
      $buff2 = [];
			if(isset($buff2['module'])) $this->module=$buff2['module'];
			else 
			{
				$this->menu="accueil";
				$this->module="accueil";
			}
		}
		$this->module_manager->charge($this->module);
	}
	
	function action() 
	{	
		if (isset($_GET['deconnect']))
		{	
			session_unset();
			if (isset($_COOKIE['icelsius'])) 
			{	
				setcookie('icelsius',false,time()+60*60*24*30,'','');
			}
			$this->admin->vide();
			$this->utile->redirection('index.php');
		}
		if (isset($_COOKIE['icelsius'])) // On renouvelle les paramètres de session à partir du login
		{	
			$_SESSION['identifiant']=$_COOKIE['icelsius'];
			setcookie('icelsius',$_COOKIE['icelsius'],time()+60*60*24*30,'','');
			$this->creer_session();
		}
		if($this->formulaire->existpost(array('login','mdp'))) // Validation issue du module Login 
		{	
			if(!$this->formulaire->fullpost(array('login','mdp'))) 
			{	
				$this->erreurlogin="Login incorrect...&nbsp;&nbsp;&nbsp;";// todo s'affiche pas
			}
			else
			{	
				$buff=$this->db->selection('utilisateurs','login',$_POST['login'],'',0);//todo
				if(empty($buff) or $buff['mdp']!=md5($_POST['mdp'])) 
				{	
					$this->erreurlogin="Login incorrect...&nbsp;&nbsp;&nbsp;";
				}
				else
				{	
					if(!isset($_POST['co'])) 
					{	
						$_SESSION['identifiant']=$_POST['login'];
					}
					else
					{
						setcookie('icelsius',$_POST['login'],time()+60*60*24*30,'','');						
					}
					$this->utile->redirection('index.php');
				}
			}
		}
		if(isset($this->core->module))
		{
			if (($this->core->module!='admin' && !$this->admin->aacces($this->core->module)) || ($this->core->module=='admin' && !$this->admin->estadmin('intranet'))||$this->core->module=="inscription" && $this->admin->estidentifie())
			{
				$this->utile->redirection('index.php');
			}	
		}
	
		if($this->admin->estidentifie() && isset($_GET['act']) && $_GET['act']=="Arcade" && isset($_GET['do']) && $_GET['do']=="newscore")
		{
			
			if($_POST['gname']=='yeti9') 
			{
				$buff=$this->db->selection('jeux','fichier','yeti9','',0);
				$_POST['gameid']=$buff['id'];
			}
			$buff=$this->db->selection('score',array('id_user','jeu'),array($_SESSION['id'],$_POST['gameid']));
			if(!empty($buff['score']) && $_POST['gscore']!="NaN" && $buff['score']<$_POST['gscore']) $this->db->modification('score','score',$_POST['gscore'],'id',$buff['id']);
			elseif(empty($buff['score'])) $this->db->ajout('score',array('id_user','jeu','score'),array($_SESSION['id'],$_POST['gameid'],$_POST['gscore']));
			$this->utile->redirection('?menu=bonus&module=jeux&action=scores');
		}
	}
	
	/** 
	 *	Charge les pr�f�rences d'un utilisateur depuis la base de donn�es dans les variables de session
	 *
	 *	@author		Pierre Claudon <claudon.pierre@gmail.com>
	 */
	
	function creer_session()
	{
		$buff=$this->db->selection('utilisateurs','login',$_SESSION['identifiant'],'',0);
		$_SESSION['identifiant']=$buff["login"];
		$_SESSION['id']=$buff["id"];
		$_SESSION['prenom']=$buff["prenom"];
		$_SESSION['nom']=$buff["nom"];
		//$_SESSION['droits']=$buff2["droits"];
	}
	
	
	function login()
	{	
		if($this->admin->estidentifie())
		{	
?>	
			<ul class="right">
				<li>
					<strong>Salut <?php echo $_SESSION['identifiant']; ?> !</strong>
				</li>
				<li>
					<strong><a href="?deconnect=1">Se d�connecter</a></strong>
				</li>
			</ul>
<?php	
		}
		else
		{
			?>

<form method="post" action="index.php">
	<div id="login1">
		<strong>login&nbsp;:&nbsp;</strong>
		<input size="10" type="text" name="login" value="<?php if(isset($_SESSION['identifiant'])) echo $_SESSION['identifiant'] ?>" />
		<strong>mdp&nbsp;:&nbsp;</strong>
		<input size="10" type="password" name="mdp" />
		<input class="valider" type="submit" value="Ok" />
	<strong>Connexion auto&nbsp;:&nbsp;</strong>
		<input type="checkbox" name="co" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="?module=inscription"><strong>S'enregistrer</strong></a>
	</div>
	<hr />
</form>

<?php

  		}
	}

	// Affichage de l'en-tête
	function en_tete()
	{	
		
		session_name(md5('yechteamisgoodforyou'));
		session_start();
		session_regenerate_id();
		if(isset($_SESSION['identifiant']) && !isset($_SESSION['nom']))
		{
			$this->creer_session();
		}
		$this->action();
		
		if(!$this->module_manager->module->identification  || $this->module_manager->module->identification && $this->admin->estidentifie())
		{	
			$this->module_manager->module->action();
		}
?>
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Yech'team !</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></meta>
		<link rel="stylesheet" type="text/css" href="css/icelsius.css"></link>
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="css/icelsius_ie.css" />
		<![endif]-->
<?php
		if(!$this->module_manager->module->identification  || $this->module_manager->module->identification && $this->admin->estidentifie()) $this->module_manager->en_tete();


?>
	
	</head>
<?php
	}
	

	// Affichage du corps
	function corps()
	{
		echo "\n<body>\n";
		
		
		
		echo "\n\t<div id=\"global\">";
			
			echo "\n\t\t<div id=\"header\">";
			
		echo "\n\t\t</div>\n";
			
echo "\n\t\t\t<div id=\"login\">";
		$this->login();
		echo "</div>";			


echo "<img src=\"images/yeti_logo.png\"/ id=\"logo\" />";		
		
		
		
		
		
		echo "\n\t\t<div id=\"menu\">";
		
		
		//if ($this->admin->estidentifie()) 
		
		$this->module_manager->menu();
		
		
	
		echo "\n\t\t</div>\n";
		echo "<hr />";
		
		
		
			$this->module_manager->menu_gauche($this->menu);
		
		echo "\n\t\t<div id=\"corps_global\">";
		echo "\n\t\t<div id=\"corps\">";
		
		if(!$this->module_manager->module->identification  || $this->module_manager->module->identification && $this->admin->estidentifie()) $this->module_manager->module->corps();
		else echo "Pour acc�der � cette section tu dois d'abord t'inscrire !";
	echo "<div id=\"lecteur\">";	
?>		<!--
   <object type="application/x-shockwave-flash" width="400" height="220" data="flvplayer.swf">
  <param name="movie" value="flvplayer.swf" />
  <param name="flashvars" value="file=film.flv" />
</object>-->
	<?php	
		echo "</div>";
		echo "<hr />";
		
		echo "\n\t\t</div>\n";
		echo "\n\t\t</div>\n";
	}
	
	// Affichage du pied de page
	function pied() 
	{
		$this->module_manager->module->pied();
		mysqli_close($this->db->ressource);
		echo "<hr />";
		echo "</div>";
		echo "\n</body>";
		echo "\n</html>";
	}
	
	// Affichage de la page
	function affiche() 
	{
		$this->en_tete();
		$this->corps();
		$this->pied();
	}
}
?>
