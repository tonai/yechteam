<?php

class formulaire 
{
	var $core;
	function formulaire(&$refcore)
	{
		$this->core=&$refcore;
	}

// Teste si tous le champs spécifiés existent (rattachée à fullpost)

	function existpost($post='') // ' ' sinon  
	{	
		if(is_array($post))
		{	
			foreach ($post as $buff)
			{	
				if(!isset($_POST[$buff])) return false;
			}
		}
	elseif($post!='') return (isset($_POST[$post]));
	return true;
}

// Teste si tous les champs spécifiés ont été remplis

	function fullpost($post)
	{	
		if (!$this->existpost($post)) return false;
		if (is_array($post))
			{	
				foreach ($post as $buff)
				{	
					if(empty($_POST[$buff])) return false;
				}	
			}
		elseif(empty($_POST[$post])) return false;
		return true;
	}

// Ajoute les champs POST spécifiés dans la base de données

	function ajoutdb($table,$ajoute='') 
	{
		if($this->existepost($ajoute))
		{
			$nomchamp=array();
			$valeurs=array();
			if (is_array($ajoute))
			{	
				foreach($_POST as $colonne=>$buff)
				{	
					if($this->core->utile->appartient($colonne,$ajoute)) 
					{	
						$nomchamp[]=$colonne;
						$valeurs[]=addslashes($buff);
					}
				}
			}
			elseif(!empty($ajoute))
			{	
				foreach($_POST as $colonne=>$buff)
				{	
					if($colonne==$ajoute)
					{	
						$nomchamp[]=$colonne;
						$valeurs[]=addslashes($buff);
					}
				}
			}
			else
			{	
				foreach($_POST as $colonne=>$buff)
				{	
					$nomchamp[]=$colonne;
					$valeurs[]=addslashes($buff);
				}
			}
			$id=$this->core->db->ajout($table,$nomchamp,$valeurs);
			return $id;
		}
	}
}

?>