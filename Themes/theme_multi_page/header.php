<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<?php wp_head(); ?>

</head>
<body  <?php body_class(); ?>>
	<p>body_class() permet de donner à chaque page ou article de mon blog une classe specifique<br> qui permet ainsi de la styliser sans utiliser de template suplémentaire</p>
	<div class="container">
		<header class="row">
			<div class="col-sm-3">
				<a href="<?php bloginfo( 'wpurl' ); ?>">
					<img src="<?php echo get_template_directory_uri() ?>/img/logo.svg" alt="" width="150" title="<?php bloginfo( 'name' ); ?>">
				</a>			
			</div>
			<div class="col-sm-9">
				<p>
					<?php bloginfo( 'description' ); ?>
				</p>
			</div>
		</header>


		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php 

				$args = array(
					'theme_location'  => '',
					'menu_class'      => 'navbar-nav mr_auto',
					'menu_id'         => 'navbarNav',
					'walker'          => new WP_Bootstrap_Navwalker()
				) ;

				wp_nav_menu( $args);

				?>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>

		</nav>

		<section class="row">
			