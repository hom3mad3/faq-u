<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Faq_U_Schule!
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<ul id="filters">
		    <li><a href="#" data-filter="*" class="selected">Everything</a></li>
			<?php
				$terms = get_terms("category"); // get all categories, but you can use any taxonomy
				$count = count($terms); //How many are they?
				if ( $count > 0 ){  //If there are more than 0 terms
					foreach ( $terms as $term ) {  //for each term:
						echo "<li><a href='#' data-filter='.".$term->slug."'>" . $term->name . "</a></li>\n";
						//create a list item with the current term slug for sorting, and name for label
					}
				}
			?>
		</ul>

		<main id="main" class="site-main" role="main">
		<nav id="site-navigation" class="main-navigation grid-item" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'faq-u' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu', 'grid-item' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->

<div><?php
     $terms_ID_array = array();
     foreach ($terms as $term)
     {
         $terms_ID_array[] = $term->term_id; // Add each term's ID to an array
     }
     $terms_ID_string = implode(',', $terms_ID_array); // Create a string with all the IDs, separated by commas
     $the_query = new WP_Query( 'posts_per_page=50&cat='.$terms_ID_string ); // Display 50 posts that belong to the categories in the string
?>
<?php if ( $the_query->have_posts() ) : ?>
    <div id="isotope-list">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
	$termsArray = get_the_terms( $post->ID, "category" );  //Get the terms for this particular item
	$termsString = ""; //initialize the string that will contain the terms
		foreach ( $termsArray as $term ) { // for each term
			$termsString .= $term->slug.' '; //create a string that has all the slugs
		}
	?>
	<div class="<?php echo $termsString; ?> item"> <?php // 'item' is used as an identifier (see Setp 5, line 6) ?>
		<h3><?php the_title(); ?></h3>
	        <?php if ( has_post_thumbnail() ) {
                      the_post_thumbnail();
                } ?>
	</div> <!-- end item -->
    <?php endwhile;  ?>
    </div> <!-- end isotope-list -->
<?php endif; ?></div>



	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
