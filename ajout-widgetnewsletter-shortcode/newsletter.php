<?php

/**
* 
*/

include_once plugin_dir_path( __FILE__ ).'/newsletterwidget.php';

class Zero_Newsletter
{
	
	public function __construct()
    {
        add_action('widgets_init', function(){register_widget('Zero_Newsletter_Widget');});
        /*
        wp_loaded qui correspond à l’instant où l’application est chargée 
        et où elle s’apprête à effectuer le rendu du thème pour la page demandée.
        */
        add_action('wp_loaded', array($this, 'save_email'));

        add_action('admin_menu', array($this, 'add_admin_menu'));

        add_action('admin_init', array($this, 'register_settings'));
    }

    public static function install()
	{
	    global $wpdb;

		// {$wpdb->prefix} met le bon prefix à la table qu'on a choisi
		return $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}zero_newsletter_email (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL);");
	}

	public static function uninstall()
	{
	    global $wpdb;

	    return $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}zero_newsletter_email;");

	    /*
		    Dans le cas de la désinstallation, la fonction appelée doit être statique 
		    (ou bien appartenir à l’espace global), ce qui n’était pas obligatoire pour l’activation.
	    */
	}

	public function save_email()
	{
	    if (isset($_POST['zero_newsletter_email']) && !empty($_POST['zero_newsletter_email'])) {
	        global $wpdb;
	        // On regarde si pas déjà presente dans la table
	        // Pas besoin de nettoyer les resultats la mthd query appelée par get_row s'en charge
	        $email = $_POST['zero_newsletter_email'];
	        $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}zero_newsletter_email WHERE email = '$email'");

	        // Si pas presente inserer, il faudrait verifier avant que c'est bien une adresse valide qui est inserée
	        if (is_null($row)) {
	            $wpdb->insert("{$wpdb->prefix}zero_newsletter_email", array('email' => $email));
	        }
	    }
	}

	public function add_admin_menu()
	{
	    add_menu_page(	
    				'Notre premier plugin', // Titre de la page sur laquelle nous serons redirigés <title> et dans get_admin_page_title()
    			 	'Zero plugin', // Le libellé du menu, le titre qui est affiché dans le menu wordpress de la gauche
    			 	'manage_options', // Droits d'accés, si pas suffisants le menu est masqué
    			 	'zero', // identifiant du menu, ce voit dans l'url
    			 	array($this, 'menu_html') // page ou fonction (ici) qui appelée pour le rendu de la page
    			 	/*
    			 	icone pour le lien (defaut), 
					Position dans le menu (defaut)
					*/
	    			);

	    $hook = add_submenu_page(
	    			'zero', // identifiant du menu parent
	    			'Newsletter', // Le titre de la nouvelle page <title> et get_admin_page_title()
	    			'Newsletter', // Le libellé du menu (sous-menu)
	    			'manage_options', // Les droits d'accés
	    			'zero_newsletter', /// L'identifiant du sous-menu
	    			array($this, 'sub_menu_html')// La fonction d'affichage
	    			);
 
    	add_action('load-'.$hook, array($this, 'process_action'));
	}

	public function menu_html()
	{
		/*
		La fonction get_admin_page_title() renvoie la valeur du premier argument 
		donné à la fonction add_menu_page().
		*/

    	echo '<h1>'.get_admin_page_title().'</h1>';
    	echo '<p>Bienvenue sur la page d\'accueil du plugin</p>';

    	?>
    	<form method="post" action="options.php">

    		<?php 
    		/*
    		register_setting( 	string $option_group, 

					    		Un nom de groupe de paramètres. 
					    		Devrait correspondre à un nom de clé d'option en liste blanche. 
					    		Les noms de clé d'option par défaut inclus dans la liste blanche incluent «général», 
					    		«discussion» et «lecture», entre autres.

    							string $option_name, 
    							Le nom d'une option pour assainir et enregistrer.

    							array $args = array() 
    							Données utilisées pour décrire le paramètre lors de l'enregistrement. (defaut)
    						)
			*/
    		settings_fields('zero_newsletter_settings') 
    		// Affiche les champs nonce, action et option_page pour une page de paramètres.
    		// L'argument est un nom de groupe de paramètres. Cela devrait correspondre au nom du groupe utilisé dans register_setting ().
    		?>
			<?php do_settings_sections('zero_newsletter_settings') ?>
			<input type="hidden" name="send_newsletter" value="1"/>
    		<?php submit_button('Envoyer la newsletter') ?>
    	</form>
    	<?php
	}

	public function sub_menu_html()
	{
		/*
		La fonction get_admin_page_title() renvoie la valeur du premier argument 
		donné à la fonction add_menu_page().
		*/

    	echo '<h1>'.get_admin_page_title().'</h1>';
    	echo '<p>Parametre de la newsletter</p>';
	}

	public function register_settings()
	{
		// Enregistrez un paramètre et ses données.

	    register_setting('zero_newsletter_settings', 'zero_newsletter_sender');
    	register_setting('zero_newsletter_settings', 'zero_newsletter_object');
    	register_setting('zero_newsletter_settings', 'zero_newsletter_content');

    	/*
    	add_settings_section( 
    						string $id, // identifiant (id) de la nouvelle section  
    						string $title, // Titre de la section affiché avant les elements des fields
    						callable $callback, // Fonction qui répercute tout contenu en haut de la section juste en dessous titre
    						string $page // Le slug-name de la page des paramètres sur laquelle afficher la section. Les pages intégrées incluent «général», «lecture», «écriture», «discussion», «média», etc. Créez les vôtres en utilisant add_options_page ();
    						)

    	Utilisez-le pour définir de nouvelles sections de paramètres pour une page d'administration. 
    	Afficher les sections de paramètres dans la fonction de rappel de votre page d'administration avec do_settings_sections (). 
    	Ajoutez des champs de paramètres à votre section avec add_settings_field () 
    	L'argument $ callback doit être le nom d'une fonction qui répercute le contenu que vous souhaitez
    	afficher en haut de la section des paramètres avant les champs réels. Il ne peut rien produire si vous voulez.
		*/
	    add_settings_section('zero_newsletter_section', 'Newsletter parameters', array($this, 'section_html'), 'zero_newsletter_settings');
	    add_settings_field('zero_newsletter_sender', 'Expéditeur', array($this, 'sender_html'), 'zero_newsletter_settings', 'zero_newsletter_section');
	    add_settings_field('zero_newsletter_object', 'Objet', array($this, 'object_html'), 'zero_newsletter_settings', 'zero_newsletter_section');
	    add_settings_field('zero_newsletter_content', 'Contenu', array($this, 'content_html'), 'zero_newsletter_settings', 'zero_newsletter_section');
	    /* Ajouter un nouveau champ à une section d'une page de paramètres */
	}

	public function section_html()
	{
	    echo 'Renseignez les paramètres d\'envoi de la newsletter.';
	    
	}

	public function sender_html()
	{
		?>
	    	<input type="text" name="zero_newsletter_sender" value="<?php echo get_option('zero_newsletter_sender')?>"/>
	    <?php
	}

	public function object_html()
	{
		?>
	    	<input type="text" name="zero_newsletter_object" value="<?php echo get_option('zero_newsletter_object')?>"/>
	    <?php
	}

	public function content_html()
	{
		?>
	    	<textarea name="zero_newsletter_content"><?php echo get_option('zero_newsletter_content')?></textarea>
	    <?php
	}

	public function process_action()
	{
	    if (isset($_POST['send_newsletter'])) {
	        $this->send_newsletter();
	    }
	}

	public function send_newsletter()
	{
	    global $wpdb;
	    $recipients = $wpdb->get_results("SELECT email FROM {$wpdb->prefix}zero_newsletter_email");
	    $object = get_option('zero_newsletter_object', 'Newsletter');
	    $content = get_option('zero_newsletter_content', 'Mon contenu');
	    $sender = get_option('zero_newsletter_sender', 'no-reply@example.com');
	    $header = array('From: '.$sender);

	    foreach ($recipients as $_recipient) {
	        $result = wp_mail($_recipient->email, $object, $content, $header);
	    }
	} 
}