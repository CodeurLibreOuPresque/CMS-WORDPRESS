<?php get_header() ?>

<article class="col-md-9">
	<h2>Ceici est une page single qui affiche un seul article</h2>
	<?php if (have_posts()):
	while (have_posts()):the_post();		
			/*$imageALaUne = get_post_thumbnail_id();
			$imgSrc = wp_get_attachment_url( $imageALaUne ); 
			$srcFullSize=wp_get_attachment_image_src($imageALaUne,'large');
			echo '<img src="'.$srcFullSize[0].'" alt="">';*/

			the_title( $before = '<h1>', $after = '</h1>', $echo = true );
			get_template_part( 'contenu', 'article' );
			?>	
		<?php endwhile; ?>
	<?php endif; ?>
</article>	

<?php get_footer() ?>