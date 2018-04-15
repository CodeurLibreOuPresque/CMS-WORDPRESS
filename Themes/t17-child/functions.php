<?php
add_action( 'wp_enqueue_scripts', 't17child_scripts' );
function t17child_scripts() {
	wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_head', 't17child_favicon' );
function t17child_favicon() {
	echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/favicon.png' . '">';
}