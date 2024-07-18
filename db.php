<?php // FINI

class db
{
	var $ressource;
	var $core;
	var $dejafait;
	var $erreur;
	var $res;

	function db(&$refcore) 
	{
		require_once "conf.php";
		$this->core=&$refcore;
		$this->ressource =@mysql_connect($host,$user,$pwd) or die("<br>Problème lors de la connexion à la base de données.");
		$this->dejafait=0;
		@mysql_select_db($database,$this->ressource) or die("<br>Problème lors de la selection de la base de données");
	}

	
/**
	 *	Effectue une requête $query, le paramètre $while permet de savoir si la requête est utilisée dans une boucle while (1) ou non (0)
	 *
	 *	Cette fonction intercepte les erreurs de requêtes.
	 *	Si l'erreur survient lors de l'utilisation par un utilisateur quelconque, le message d'erreur lui dit de contacter un administrateur
	 *	Si elle survient lors de l'utilisation par l'administrateur, la requête posant problème s'affiche.
	 *
	 *	@author		Pierre Claudon <claudon.pierre@gmail.com>
	 *	@param		$query			string
	 *	@param		$while			int
	 *	@return		array,error
	 */	
	
	function requete($query,$while=1)
	{
		if ($this->dejafait==0)
		{
			$this->res=mysql_query($query,$this->ressource);
			$this->dejafait=(mysql_affected_rows($this->ressource)+1);
		}
		if($this->dejafait==1)
		{
			$this->dejafait=0;
			return;
		}
		$this->dejafait-=1;
		$resultat=@mysql_fetch_array($this->res) or (($this->core->admin->estAdmin('intranet') and die( "<br>Problème avec la requête suivante : ".$query)) or (!$this->core->admin->estAdmin() and die( "<br>Une erreur est survenue, veuillez contacter un administrateur")));
		if($while=="0") $this->dejafait=0;
		return $resultat;
	}

	function selection($table,$champ='',$valeur='',$ordre='',$while='1')
	{
		$query="SELECT * FROM ".$table;
		if (!empty($champ))
		{
			$query.=" WHERE ";
			if (is_array($champ)) 
			{
				$i=0;
				foreach ($champ as $buff) 
				{
					if (0!=$i)	$query.=" AND ";
					$query.=$buff."='".$valeur[$i]."'";
					$i++;
				}
			}
			else $query.=$champ."='".$valeur."'";
		}
		if (!empty($ordre))	$query.=" ORDER by ".$ordre;
		return $this->requete($query,$while);
	}
		
	function ajout($table,$champ,$valeur)
	{
		$query="INSERT INTO ".$table;
		if (!empty($champ) && !empty($valeur))
		{
			if (is_array($champ)) 
			{
				$i=0;
				$query_champ=" (";
				$query_valeur="(";
				foreach($champ as $buff) 
				{
					if (0!=$i)	
					{
						$query_champ.=",";
						$query_valeur.=",";
					}
					$query_champ.=$buff;
					$query_valeur.="'".$valeur[$i]."'";
					$i++;
				}
				$query.=$query_champ.") VALUES ".$query_valeur.")";
			}
			else $query.="(".$champ.") VALUES ('".$valeur."')";
		}
		$resultat=@mysql_query($query,$this->ressource) or ($this->core->admin->estAdmin('intranet') and die( "<br>Problème avec la requête suivante : ".$query)) or (!$this->core->admin->estAdmin() and die( "<br>Une erreur est survenue, veuillez contacter un administrateur"));
		$id=mysql_insert_id($this->ressource);
		return $id;
	}
		
	function modification($table,$champ,$valeur,$select,$select_valeur)
	{	//if (!empty($champ)) tester avec rien
		$query="UPDATE ".$table." SET ";
		if (is_array($champ))
		{
			$i=0;
			foreach($champ as $buff)
			{	
				if (0!=$i) $query.=",";
				$query.=$buff."="."'".$valeur[$i]."'";
				$i++;
			}
		}
		else $query.=$champ."="."'".$valeur."'";
		if (!empty($select)) 
		{
			$query.=" WHERE ";
			if (is_array($select))
			{	
				$i=0;
				foreach ($select as $buff)
				{	
				if (0!=$i) $query.=" AND ";
					$query.=$buff."="."'".$select_valeur[$i]."'";
					$i++;
				}
			}
			else $query.=$select."="."'".$select_valeur."'";
		}
		$resultat=@mysql_query($query,$this->ressource) or ($this->core->admin->estAdmin('intranet') and die( "<br>Problème avec la requête suivante : ".$query)) or (!$this->core->admin->estAdmin() and die( "<br>Une erreur est survenue, veuillez contacter un administrateur"));
	}

	function suppression ($table,$champ='',$valeur='')
	{	
		{
			$query="DELETE FROM ".$table;
			if (!empty($champ)) $query.=" WHERE ";
			if (is_array($champ))
			{
				$i=0;
				foreach ($champ as $buff)
				{	
					if (0!=$i) $query.=" AND ";
					$query.=$buff."="."'".$valeur[$i]."'";
					$i++;
				}
			}
			else $query.=$champ."="."'".$valeur."'";
		}
		$resultat=@mysql_query($query,$this->ressource) or ($this->core->admin->estAdmin('intranet') and die( "<br>Problème avec la requête suivante : ".$query)) or (!$this->core->admin->estAdmin() and die( "<br>Une erreur est survenue, veuillez contacter un administrateur"));
	}
}

?>