<?php

require_once 'module.php';

class login extends module {
	var $modulemanager;
	var $core;
	var $erreurlogin;

	function __construct(&$refmm,&$refcore)
	{
		$this->modulemanager=&$refmm;
		$this->core=&$refcore;
	}

	function corps()
	{
			echo $this->core->erreurlogin;
			echo "\t\t\t\t<a href=\"?module=oubli\">Mot de passe oubli�</a>\n";
			if (isset($_POST['login'])) $login=$_POST['login'];
			else $login='';
?>			
				<form method="post" action="index.php">
					<ul class="aligne">
						<li class="aligne">
							login&nbsp;:&nbsp;
							<input size="15" type="text" name="login" value="<?php echo $login ?>" />
						</li>
						<li class=\"aligne\">
							mot de passe&nbsp;:&nbsp;
							<input size="15" type="password" name="mdp" />
							<br />
						</li>
						<li class="aligne">
							<input class="valider" type="submit" value="Ok" />
							<br />						
						</li>
						<li class="aligne">
							Connexion automatique&nbsp;:&nbsp;
							<input class="checkbox" type="checkbox" name="co" />
							<br />
						</li>
					</ul>
				</form>
<?php			
	}
}
?>
