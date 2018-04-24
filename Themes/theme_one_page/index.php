 <!DOCTYPE html>
 <html>
 <head>

  <?php wp_head(); ?>

  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
  <!-- Compiled and minified CSS Lightbox 2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

  <div class="navbar-fixed"> <!-- fixe la barre de menu -->
   <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="" width="100"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">


        <?php 
        // the query
        $the_query = new WP_Query( 
          array( 
            'category_name' => 'one-page', 
            'order'   => 'ASC'
          ) 
        );
        ?>

        <?php if ( $the_query->have_posts() ) : ?>

          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <li><a href="#lien_<?php the_id(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
          <li><a href="#mailForm">Contactez-nous</a></li>

          <?php wp_reset_postdata(); ?>

        <?php endif; ?>



      </ul>
      <ul class="side-nav" id="mobile-demo">

        <?php if ( $the_query->have_posts() ) : ?>

          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <li><a href=""><?php the_title(); ?></a></li>
          <?php endwhile; ?>
          <li><a href="#mailForm">Contactez-nous</a></li>
          <?php wp_reset_postdata(); ?>

        <?php endif; ?>

      </ul>
    </div>
  </nav>
</div>






<?php 
// the query

$the_query = new WP_Query( 
  array( 
    'category_name' => 'one-page', 
    'order'   => 'ASC'
  ) 
);

?>

<?php if ( $the_query->have_posts() ) : ?>

  <!-- pagination here -->



  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>




    <?php 

    $idPost=get_the_id();
    if($idPost==10): // Pour l'article 4 seulement
    ?>

    <div class="parallax-container" id="lien_<?php the_id(); ?>">
      <div class="parallax"><img src="<?php echo $imgSrc; ?>" alt=""></div>
    </div>
    <div class="section white">
      <div class="row container">
        <h2 class="header"><?php the_title(); ?></h2>
        <p class="grey-text text-darken-3 lighten-3"> 
          <!--  j'affiche le portfolio -->
          <?php 
          $innerquery = new WP_Query( 
            array( 
              'category_name' => 'portfolio', 
            ) 
          );

          ?>


          <div id="filters" class="button-group">  

           <button class="button is-checked" data-filter="*">Afficher tout</button>

           <?php 

           $tags=get_tags();

           foreach ($tags as $tag) {
             echo'<button class="button" data-filter=".'.$tag->name.'">'.$tag->name.'</button>';
           }

           ?>



         </div>

         <div class="isotope">
          <?php



          while ( $innerquery->have_posts() ) : $innerquery->the_post(); 

        //je récupère l' "image à la une" ;

            $imageALaUnePortfolio=get_post_thumbnail_id( );

            $src=wp_get_attachment_image_src($imageALaUnePortfolio,'thumbnail');
            $srcFullSize=wp_get_attachment_image_src($imageALaUnePortfolio,'large');


            ?>


            <?php 
            $postTags=get_the_tags(); 

            $tagS='';

            if($postTags){

              foreach ($postTags as $tag ) {
                $tagS .= $tag->name;
              }
            }
            $tagS=trim($tagS);

            ?>

            <div class="element-item <?php echo $tagS ?> ">

              <a href="<?php  echo $srcFullSize[0] ?>" data-lightbox="image-1" data-title="<?php the_title( ); ?>">
                <img src="<?php  echo $src[0] ?>" alt="">
              </a>
              <h3 class="name"><?php  the_title( );?></h3>

            </div>








          <?php endwhile;
          wp_reset_postdata();
          ?>
        </div>
      </p>
    </div>
  </div>


<?php else: ?>





  <?php // je récupère l' "image à la une" 
  $imageALaUneId=get_post_thumbnail_id( );
  $imgSrc=wp_get_attachment_url( $imageALaUneId );
  ?>


  <div class="parallax-container" id="lien_<?php the_id(); ?>">
    <div class="parallax"><img src="<?php echo $imgSrc; ?>" alt=""></div>
  </div>
  <div class="section white">
    <div class="row container">
      <h2 class="header"><?php the_title(); ?></h2>
      <p class="grey-text text-darken-3 lighten-3"> <?php the_content( ); ?></p>
    </div>
  </div>
<?php endif; ?>


<?php endwhile; ?>

<?php endif; ?>

<!-- end of the loop -->

<!-- pagination here -->

<?php wp_reset_postdata(); ?>







<div class="section white">
  <div class="row container">
    <h2 class="header">Ecrivez-nous</h2>
    <p class="grey-text text-darken-3 lighten-3">

      <div id="confirmation"></div>
      <form type="post" action="" id="mailForm">

        <label for="nom">Nom:</label>
        <input name="nom" type="text" />

        <label for="email">Email:</label>
        <input name="email" type="text" />

        <label for="message">Message:</label>
        <textarea name="message"></textarea>

        <input type="submit">
      </form>

    </p>
  </div>
</div>


<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>







<script>

  /* Code d'initialisation du parallax */


  $(document).ready(function(){
    $('.parallax').parallax();
    $(".button-collapse").sideNav();

  });

</script>

<script>
 $(document).ready(function(){

   $('nav a').click(function(){
     $('html, body').animate({
       scrollTop: $( $.attr(this, 'href') ).offset().top
     }, 500);
     return false;
   });
 });
</script>

<script>

  jQuery('#mailForm').submit(ajaxSubmit);

  function ajaxSubmit(){

    var nouveauMail = jQuery(this).serialize();

    jQuery.ajax({
      type:"POST",
      url: "wp-admin/admin-ajax.php",
      data: { action: "my_action", 'formData':nouveauMail},
      success:function(donneees){
        jQuery("#confirmation").html(donneees);
      }
    });

    return false;
  }
</script>




<script>
  $( document ).ready( function() {
  // init Isotope
  var $container = $('.isotope').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    getSortData: {
      name: '.name',
      symbol: '.symbol',
      number: '.number parseInt',
      category: '[data-category]',
      weight: function( itemElem ) {
        var weight = $( itemElem ).find('.weight').text();
        return parseFloat( weight.replace( /[\(\)]/g, '') );
      }
    }
  });

// filter functions
var filterFns = {
// show if number is greater than 50
numberGreaterThan50: function() {
  var number = $(this).find('.number').text();
  return parseInt( number, 10 ) > 50;
},
// show if name ends with -ium
ium: function() {
  var name = $(this).find('.name').text();
  return name.match( /ium$/ );
}
};

// bind filter button click
$('#filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
// use filterFn if matches value
filterValue = filterFns[ filterValue ] || filterValue;
$container.isotope({ filter: filterValue });
});

/*  // bind sort button click
$('#sorts').on( 'click', 'button', function() {
var sortByValue = $(this).attr('data-sort-by');
$container.isotope({ sortBy: sortByValue });
});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
var $buttonGroup = $( buttonGroup );
$buttonGroup.on( 'click', 'button', function() {
$buttonGroup.find('.is-checked').removeClass('is-checked');
$( this ).addClass('is-checked');
});
});*/

});



</script>




<?php wp_footer(); ?>
</body>
</html>
