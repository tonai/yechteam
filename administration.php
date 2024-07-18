<?php

class administration
{
	var $core;
	var $utilisateur;
	
	function administration(&$refcore)
	{
		$this->core=&$refcore;
		$this->utilisateur=array();
	}
	
	function vide()
	{
		$this->utilisateur='';
	}
	
	function estidentifie()
	{
		return (isset($_SESSION['identifiant']));
	}
	
	function aacces($module)
	{
		/*if($module=='pref' || $module=='accueil' || $module=='oubli') return true;
		if($module=='objectifs') return $this->estadmin('objectifs');
		if(isset($_SESSION['droits'])) {
			$droits=unserialize($_SESSION['droits']);
			return $this->core->utile->appartient($module."C",$droits);
		}
		else*/ return true;
	}
	
	function estadmin($module)
	{
		if(isset($_SESSION['droits'])) {
			$droits=unserialize($_SESSION['droits']);
			return $this->core->utile->appartient($module."D",$droits);
		}
		else return true;
	}
}

?>