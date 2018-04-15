<?php
/*
Plugin Name: Ajout widget & shortcode
Description: Plugin ayant pour objectifs: 1/ Declaration widget de newsletter 2/ Shortcode liste de lienvers les articles, [zero_recent_articles numberposts=3] Liste des articles [/zero_recent_articles]
Version: 0.1
Author: Souhayb BENSAIDI
*/


class Zero_Plugin
{
	public $instance_zero_newsletter = null;
    public $instance_zero_recent = null;
	

    public function __construct()
    {
    	// Inclure tout les fichiers
        include_once plugin_dir_path( __FILE__ ).'/newsletter.php';
        include_once plugin_dir_path( __FILE__ ).'recent.php';

        // Trace l'activation du plugin et insere fonction specifiques 
        // Ici pas besoin d'instanciation de la classe Zero_Newsletter car use mthd static
        register_activation_hook(__FILE__, array('Zero_Newsletter', 'install'));

        // Instancier toute les classes et les mettres dans des variables publics
        $this->instance_zero_newsletter = new Zero_Newsletter();
        $this->instance_zero_recent = new Zero_Recent();


        // Trace la desactivation du plugin et insere fonction specifiques 
        register_uninstall_hook(__FILE__, array('Zero_Newsletter', 'uninstall'));

    }


}

$ZP = new Zero_Plugin;
$IZN = $ZP->instance_zero_newsletter;
$IZR = $ZP->instance_zero_recent;



