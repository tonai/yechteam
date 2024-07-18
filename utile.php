<?php

class utile 

{
	var $core;
	function utile(& $refcore)
	{
		$this->core=&$refcore;
	}
	
	function appartient($element,$tableau) 
	{
		if(empty($tableau)) return false;
		else 
		{
			foreach($tableau as $compare) 
			{
				if ($element==$compare) return true;
			}
		}
		return false;
	}

	function redirection($page) {
		header('location: '.$page);
		exit();
	}
	
	function getip ()
	{
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif(isset($_SERVER['REMOTE_ADDR'])) $ip=$_SERVER['REMOTE_ADDR'];
		else $ip="essai";
		return $ip;
	}
}
	/**
	 *	Permet de gérer l'ordre dans la table $table d'une base de données
	 *
	 *	Pour gérer l'ordre d'affichage d'éléments d'une table, il est possible d'utiliser un champ ordre.
	 *	Lors d'ajout, de modification ou de suppression d'éléments dans cette table, il faut renoméroter les éléments restants, c'est le but de cette fonction
	 *	$nom est une variable contenant le nom de la clef primaire de la table et $evite est la valeur de l'id de l'élément modifié ou ajouté et qui ne doit pas être renuméroté.
	 *	$testee est le nom d'un champ sur lequel le tri doit être fait et $valeur sa valeur.	
	 *
	 *	@author		Pierre Claudon <claudon.pierre@gmail.com>
	 *	@param		$table		string
	 *	@param		$nom		string
	 *	@param		$evite		string
	 *	@param		$testee		string
	 *	@param		$valeur		string
	 */

/*	function renumerotation($table,$nom,$evite='',$testee='',$valeur='') {
		$i=1;
		if(!empty($evite)) {
			$buff=$this->core->db->selection($table,$nom,$evite,'',0);
			$j=$buff['ordre'];
			while($buff=$this->core->db->selection($table,$testee,$valeur,'ordre')) {
				if($buff[$nom]!=$evite) {
					if ($i==$j) $i++;
					$this->core->db->modification($table,'ordre',$i,$nom,$buff[$nom]);
					$i++;
				}
			}
		}
		else {
			while($buff=$this->core->db->selection($table,$testee,$valeur,'ordre')) {		
				$this->core->db->modification($table,'ordre',$i,$nom,$buff[$nom]);
				$i++;
			}
		}
	}
	*/

?>