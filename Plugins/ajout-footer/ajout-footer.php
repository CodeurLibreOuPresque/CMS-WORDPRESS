<?php
/*
Plugin Name: Ajout/Suppression texte en footer 
Description: Un plugin pour ajouter un texte en pied de page et utilisation de remove_action pour annuler cette action
Version: 0.1
Author: Souhayb Bensaidi
*/


// Hook the 'wp_footer' action, run the function named 'BS_Add_Text()'
add_action("wp_footer", "BS_Add_Text");

// Hook the 'wp_head' action, run the function named 'BS_Remove_Text()'
add_action("wp_head", "BS_Remove_Text");
 
// Define the function named 'BS_Add_Text('), which just echoes simple text
function BS_Add_Text()
{
  echo "<p style='color: black;'>After the footer is loaded, my text is added!</p>";
}

// Define the function named 'BS_Remove_Text()' to remove our previous function from the 'wp_footer' action
function BS_Remove_Text()
{
	// Monday Tuesday Wednesday Thursday Friday Saturday
  if (date("l") === "Sunday") {

    // Target the 'wp_footer' action, remove the 'BS_Add_Text' function from it
    remove_action("wp_footer", "BS_Add_Text");
  }
}

