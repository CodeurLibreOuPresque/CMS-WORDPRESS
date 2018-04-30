<?php get_header() ?>
<p>A l'attention des articles de la categorie 2<br>
Il suffit de mettre dans le nom du fichier category- suivie du slug (identifiant) de l'article</p>
<article class="col-md-9">
	<h2>Ceci est une page d'archive permettant de recuperer le blog d'une categorie</h2>
	<?php if (have_posts()):
	while (have_posts()):the_post();		
			/*$imageALaUne = get_post_thumbnail_id();
			$imgSrc = wp_get_attachment_url( $imageALaUne ); 
			$srcFullSize=wp_get_attachment_image_src($imageALaUne,'large');
			echo '<img src="'.$srcFullSize[0].'" alt="">';*/

			?>
			<a href="<?php the_permalink(); ?>"><?php the_title( $before = '<h1>', $after = '</h1>', $echo = true ) ?></a>
			<?php 
			get_template_part( 'contenu', 'article' );
			?>	
		<?php endwhile; ?>
	<?php endif; ?>
</article>	

<?php get_footer() ?>