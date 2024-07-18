<?php

class module_manager
{
	var $core;
	var $module;
	var $module_smenu;
	var $menu_tableau = array(	"accueil"=>"1",
													"equipe"=>"2",
													"evenements"=>"3",
													"bonus"=>"4",
													"partenaires"=>"5"
												);
	
	function __construct(&$refcore,&$style)
	{
                $this->core=&$refcore;
	}

	function charge($nom,$num=FALSE) // TRUE si juste utilisé pour lister les propriétés
	{
		require_once 'modules/'.$nom.'.mod.php';
		if ($num)	$this->module_smenu=new $nom($this,$this->core);
		else $this->module=new $nom($this,$this->core);	
	}
    
	function en_tete() // POUR LE CSS OU JAVASCRIPT
 	{
		echo "\n<style type=\"text/css\">";
		if (isset($this->core->module) || $_GET['module']=='utile')
		{
			// $buff=$this->core->db->selection('sous_menu','module',$this->core->module,'',0);
      $buff = [];
			echo "\n#menu_gauche #smenu".$buff['ordre']." {display:block;}"; 
			if ($_GET['module']=='utile') echo "\n#menu_gauche #smenu0{display:block;}"; 
		}
		echo "\n</style>";
		$this->module->en_tete();
	}
		
	function menu()	// Barre de menu principale
	{	
		echo "\n<a href=\"?menu=accueil\" id=\"accueil\"></a>";
		echo "\n<a href=\"?menu=equipe\" id=\"equipe\"></a>";
		echo "\n<a href=\"?menu=evenements\" id=\"evenements\"></a>";
		echo "\n<a href=\"?menu=bonus\" id=\"bonus\"></a>";
		echo "\n<a href=\"?menu=partenaires\" id=\"partenaires\" ></a>";
	}
		
	function menu_gauche($menu) // Barre de menu gauche permanent
	{	
		echo "\n<dl id=\"menu_gauche\">";
		$i=1;
    // $buff=$this->core->db->selection('sous_menu','id_menu',$this->menu_tableau[$menu],'ordre');
    $buff = false;
		while ($buff)		
		{
			$this->charge($buff['module'],TRUE);
			if(!$this->module_smenu->identification  || $this->module_smenu->identification && $this->core->admin->estidentifie())
			{echo "\n<dt class=\"titre_smenu\">";
			echo "\n<a href=\"?menu=".$menu."&module=".$buff['module']."\">".$buff['nom']."</a>";
			echo "\n</dt>";	
			echo "\n<dd id=\"smenu".$i."\">";
			echo "\n<ul>";
			foreach ($this->module->actions_module as $nom=>$lien)
			{
				echo "\n<li><a href=\"?menu=".$menu."&module=".$buff['module']."&action=".$lien."\">$nom</a></li>";
			}
			echo "\n</ul>\n</dd>";
			$i++;	
		}
		}
		echo "\n<dt class=\"titre_smenu\" id=\"titre_smenu0\">";
		echo "\n<a href=\"?menu=".$this->core->menu."&module=utile\">Liens utiles</a>";
		echo "\n</dt>";	
		echo "\n<dd id=\"smenu0\">";
		echo "\n<ul>";
		echo "\n<li><a href=\"http://eleves.ec-lille.fr\" target=\"_blank\" >Portail Centrale</a></li>";
		echo "\n<li><a href=\"http://mail.centraliens-lille.org\" target=\"_blank\" >Mail Centralien</a></li>";
		echo "<br />";
		echo "<br />";
		echo "\n<li><a href=\"http://www.google.fr\" target=\"_blank\" >Google</a></li>";
		echo "\n<li><a href=\"http://www.youtube.com\" target=\"_blank\" >Youtube</a></li>";
		echo "<br />";
		echo "<br />";
		echo "\n<li><a href=\"http://www.clubic.com\" target=\"_blank\" >Clubic</a></li>";
		echo "\n<li><a href=\"http://www.clubic.com/s\" target=\"_blank\" >Comparateur de prix</a></li>";
		echo "\n</ul></dd>";
		echo "\n</dl>";
		
	}
}
/*if($this->core->admin->estadmin('intranet'))
		{
			$this->charge('admin',TRUE);
			echo "<dt class=\"titre_smenu\" id=\"titre_smenu0\">";
			echo "<a href=\"?menu=".$menu."&module=admin\">Administration</a>";
			echo "</dt>";	
			echo "<dd id=\"smenu0\">";
			echo "<ul>";
			foreach ($this->module->actions_module as $element)
			{
				echo "<li><a href=\"\">$element</a></li>";
			}
			echo "</ul></dd>";
		}*/
		
			
			
		
?>