<?php
//endroit où toutes les fonctions de votre plugin seront stockées

/*
C’est une excellente idée de regrouper des fonctions similaires 
et d’écrire un commentaire multi-lignes au-dessus de chaque groupe décrivant le groupe, 
suivi d’un court commentaire d’une seule ligne au-dessus de chaque fonction, le décrivant brièvement.
*/

/*
 * Add my new menu to the Admin Control Panel
 */

add_action( 'admin_menu', 'BS_Add_My_Admin_Link' );
 
// Add a new top level menu link to the ACP
function BS_Add_My_Admin_Link()
{
  add_menu_page(
        'My Admin Page', // Title of the page
        'Menu ajouté', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'ajout-menu-admin/includes/BS-first-acp-page.php' // The 'slug' - file to display when clicking the link
    );
}