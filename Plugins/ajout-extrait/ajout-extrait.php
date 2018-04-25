<?php
/*
Plugin Name: Ajouter extrait 
Description: Ajouter un élèment à l'extrait
Version: 0.1
Author: Souhayb Bensaidi
*/

// Hook the get_the_excerpt filter hook, run the function named mfp_Add_Text_To_Excerpt
add_filter("get_the_excerpt", "BS_Add_Text_To_Excerpt");

// Take the excerpt, add some text before it, and return the new excerpt
function BS_Add_Text_To_Excerpt($old_Excerpt)
{
	  $old_Excerpt .= "<b>Ajout à l'extrait</b>";
	  return $old_Excerpt;
}