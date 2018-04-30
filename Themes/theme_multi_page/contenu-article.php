<?php 	the_content();
the_post_thumbnail();

			$titre = get_the_title(); /*mettre get devant toutes les fonctions wp commentcant 
			par the permet de recuperer leur valeur sans les afficher*/
			$titre = strtoupper($titre);

			?>