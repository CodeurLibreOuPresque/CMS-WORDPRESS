<?php 
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
set_post_thumbnail_size( $width = 1000, $height = 500, $crop = true);
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );/*Ajoute balise title dans head car non presente auparavant*/

	/**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	function theme_multipage_scripts() {
		wp_deregister_script( 'jquery' );// Pour etre certain que jquery n'est pas déjà charger et éviter les conflits
		wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
		wp_enqueue_script( 'bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js', array( 'jquery' ), false, false );
		wp_enqueue_style( 'bootstrapcss', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css');
	}
	add_action( 'wp_enqueue_scripts', 'theme_multipage_scripts' );
	

	register_nav_menus( array(
		'Primaire' => __('menu primaire', 'test')
	) );


	function BS_widget_register(){


	/**
	 * Creates a sidebar
	 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
	 */
	$args = array(
		'name'          => __( 'Sidebar de droite', 'text-domain' ),
		'id'            => 'sidebar_droite',
		'description'   => 'test de description',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	);
	
	register_sidebar( $args );

	/**
	 * Creates a sidebar
	 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
	 */
	$args = array(
		'name'          => __( 'Sidebar footer', 'text-domain' ),
		'id'            => 'sidebar_footer',
		'description'   => '',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	);
	
	register_sidebar( $args );
	
}



add_action( 'widgets_init', 'BS_widget_register');


/*Fonction pour faciliter le template naming

function my_single_template() {

    global $wp_query, $post;
    if(file_exists(TEMPLATEPATH.'/single-' . $post->ID . '.php'))
        return TEMPLATEPATH.'/single-' . $post->ID . '.php';




    $curauth = get_userdata($wp_query->post->post_author);

    if(file_exists(TEMPLATEPATH . '/single-author-' . $curauth->user_nicename . '.php'))
        return TEMPLATEPATH . '/single-author-' . $curauth->user_nicename . '.php';

    elseif(file_exists(TEMPLATEPATH . '/single-author-' . $curauth->ID . '.php'))
        return TEMPLATEPATH  . '/single-author-' . $curauth->ID . '.php';





    foreach((array)get_the_category() as $cat){

        if(file_exists(TEMPLATEPATH . '/single-cat-' . $cat->slug . '.php'))
            return TEMPLATEPATH . '/single-cat-' . $cat->slug . '.php';

        elseif(file_exists(TEMPLATEPATH . '/single-cat-' . $cat->term_id . '.php'))
            return TEMPLATEPATH . '/single-cat-' . $cat->term_id . '.php';
    }




    $wp_query->in_the_loop = true;
    //Return: (bool) True if caller is within loop, false if loop hasn't started or ended.

    foreach((array)get_the_tags() as $tag){

        if(file_exists(SINGLE_PATH . '/single-tag-' . $tag->slug . '.php'))
            return SINGLE_PATH . '/single-tag-' . $tag->slug . '.php';

        elseif(file_exists(SINGLE_PATH . '/single-tag-' . $tag->term_id . '.php'))
            return SINGLE_PATH . '/single-tag-' . $tag->term_id . '.php';

    }
    $wp_query->in_the_loop = false;





    if(file_exists(TEMPLATEPATH . '/single.php'))
        return TEMPLATEPATH . '/single.php';

    return $single;

}

add_filter('single_template', 'my_single_template');

 */


?>