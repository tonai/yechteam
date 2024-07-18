<?php

class module
{
	
	var $actions_module=array();
	var $identification=FALSE;
	function nom()
	{
		return get_class($this);
	}
	
	function action()
	{
	}
	
	function en_tete()
	{	
		echo "\t<title>Yech'team !</title>\n";
	}
	
	function corps()
	{
	}
	
	function pied()
	{
	}
}

?>