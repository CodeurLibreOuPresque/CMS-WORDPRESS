<?php get_header() ?>
<?php 
/*
* Template name: template pour la page de contact
*
*
*/
?>
<article class="col-md-6">
	<h2>Ceci est un modele pour page  de contact il faut aller dans l'arriere site pour le selectionner</h2>
	<?php if (have_posts()):
	while (have_posts()):the_post();		
			/*$imageALaUne = get_post_thumbnail_id();
			$imgSrc = wp_get_attachment_url( $imageALaUne ); 
			$srcFullSize=wp_get_attachment_image_src($imageALaUne,'large');
			echo '<img src="'.$srcFullSize[0].'" alt="">';*/

			the_title( $before = '<h1>', $after = '</h1>', $echo = true );
			the_content();
			the_post_thumbnail();

			$titre = get_the_title(); /*mettre get devant toutes les fonctions wp commentcant 
			par the permet de recuperer leur valeur sans les afficher*/
			$titre = strtoupper($titre);
			?>	
		<?php endwhile; ?>
	<?php endif; ?>
</article>	
<article class="col-md-3">
	Coordonnéées
</article>

<?php get_footer() ?>