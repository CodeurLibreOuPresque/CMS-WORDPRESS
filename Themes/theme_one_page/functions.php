<?php

/*functions.php est l'endroit où on donne des ordres 
au back-office de wordpress*/

add_theme_support( 'post-thumbnails' );

add_action('wp_ajax_my_action', 'my_action');

add_action('wp_ajax_nopriv_my_action', 'my_action');

function my_action(){

	parse_str($_POST['formData']);
	
	if(empty($nom) || empty($email)){
		echo "Aucune données";
	}
	else{
		$nom = filter_var($nom, FILTER_SANITIZE_STRING);
		$message = filter_var($message, FILTER_SANITIZE_STRING);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);


		$message_envoye= 'Nom : '.PHP_EOL.$nom;
		$message_envoye.= 'Email : '.PHP_EOL.$email;
		$message_envoye.= 'Message : '.PHP_EOL.$message;
		
		$subject = 'message du site';

		$to = get_option('admin_email');
		
		$header = 'From :'.get_option('blogname').' '.get_option('admin_email');

		var_dump(wp_mail($to, $subject, $message_envoye, $header));

		if(wp_mail($to, $subject, $message_envoye)){
			echo '<h3>Message Envoyé</h3>';
		}else{
			echo'<h3>Message non envoyé</h3>';
		}


	}
	wp_die();
}


?>