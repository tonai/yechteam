<?php

require_once 'module.php';

class accueil extends module
{
	var $modulemanager;
	var $core;
	var $erreur;
	var $visible;
	var $style;
	
	function accueil(&$refmm,&$refcore)
	{
		$this->modulemanager=&$refmm;
		$this->core=&$refcore;
		$this->erreur='';
		$this->emplacement='1';
		if (isset($_GET['visible'])) $this->visible=$_GET['visible'];
		else $this->visible='on';
		$this->authentification=false;
	}
	
	function action()
	{
	}
	
	function corps()
	{	

?>		
		03/04/07 - News post�e par la yech'team<h4>Faites votre choix !</h4> 
		<p>H� oui demain c'est le grand jour alors surtout n'oubliez pas de voter et que le meilleur gagne ! </p>
		<hr class="normal" />
		01/04/07 - News post�e par TuxP<h4>Play again !</h4> 
		<p>La section bonus est maintenant pr�te avec pour l'instant 4 jeux � ta disposition ! C'est toi le meilleur ? Alors essaies de battre la yech'team si tu le peux :)</p>
		<hr class="normal" />
		01/04/07 - News post�e par Encelade<h4>Poisson d'avril !</h4> 
		<p>Rien � faire cet apr�m ? Alors viens jouer sur la pelouse de la rez avant de mater le monde de n�mo au foyer ! Et pour finir, plantage du bel arbre que tu as pu apercevoir pendant notre repas cul-terreux !</p>
		<hr class="normal" />
		31/03/07 - News post�e par Nodren<h4>Soir�e cul-terreux</h4> 
		<p>Un grand merci � tous ceux qui sont venus d�guster notre poulet au curry et nos vins d�licieux !</p>
		<hr class="normal" />
		
		23/03/07 - News post�e par Encelade<h4>Solidarit� Sidaction</h4> 
		<p>Demain soir � partir de 22h viens au foyer pour soutenir Sidaction avec la yech'team&nbsp;! Durant la soir�e nous te proposerons T-shirts, porte cl�s et pins au profit de la lutte contre le sida. Mais ce sera aussi l'occasion d'oublier les partiels (ou le reste) alors viens enflammer le dancefloor ! </p>
		<hr class="normal" />
		19/03/07 - News post�e par TuxP<h4>Nouveaux �v�nements</h4> 
		<p>Le programme de campagne est en ligne alors fonces car tu es le premier concern�&nbsp;! Et sur ta lanc�e jettes un oeil au calendrier et r�serves vite ta place pour le Lasergame !</p>
		<hr class="normal" />
		18/03/07 - News post�e par TuxP<h4>Pti d�j</h4> 
		<p>N'oublies pas de r�server ton petit d�j pour demain matin !</p>
		<hr class="normal" />
		16/03/07 - News post�e par TuxP<h4>Premier �v�nement</h4> 
		<p>Ce soir la yech'team te propose un repas tartiflette � domicile et un open glace en AB1 et F1 ! </p>
		<p>Pour te faire livrer rendez-vous dans la section '�v�nements', cliques sur 'calendrier' et fais ton choix ! A ce soir !</p>
		<hr class="normal" />
		<h4>Lancement de la campagne</h4>
		<p>C'est parti !!! Aujourd'hui la campagne commence et pour cette occasion tr�s sp�ciale le yech'ti sort de son antre pour... s'�clater pendant 4 semaines de folies au rythmes des soir�es endiabl�es et petits d�j � domicile !</p>
		<p>D�s ce soir la yech'team te propose un repas tout droit sorti des montagnes ainsi que des glaces ! Profites des derni�res heures de sommeil qu'il te reste... </p>
		Le site se remplira au fur et � mesure de la campagne alors garde un oeil sur les bonus !
		
		
		
		
<?php	
	
	}
	
}