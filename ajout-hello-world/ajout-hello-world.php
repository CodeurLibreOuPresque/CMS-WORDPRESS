<?php
/* 
  Plugin Name: Ajouter une ligne de texte 
  Description: Ce plugin permet d'afficher une ligne de texte au début  et la fin de chaque article. 
  Version: 0.1 
  Author: Souhayb Bensaidi
*/

function hello_world( $content ){ 
  if( is_single() )
  { 
    $text = "<p>Hello Word</p>";
   
    return $text . $content . $text; 
  } 
  else
  { 
    return $content; 
  } 
}

add_action('the_content', 'hello_world'); 
