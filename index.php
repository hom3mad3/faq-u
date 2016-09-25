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

		<nav id="filters" class="main-navigation">
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
</nav>



<?php $the_query = new WP_Query( 'posts_per_page=50' ); //Check the WP_Query docs to see how you can limit which posts to display ?>
<?php if ( $the_query->have_posts() ) : ?>
    <div id="isotope-list">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
	$termsArray = get_the_terms( $post->ID, "category" );  //Get the terms for this particular item
	$termsString = ""; //initialize the string that will contain the terms
		foreach ( $termsArray as $term ) { // for each term
			$termsString .= $term->slug.' '; //create a string that has all the slugs
		}
	?>
	<article class="<?php echo $termsString; ?> item post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // 'item' is used as an identifier (see Setp 5, line 6) ?>

		<header class="entry-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>

			<?php
			endif; ?>
		</header><!-- .entry-header -->

					<?php if ( has_post_thumbnail() ) {
											the_post_thumbnail();
								} ?>

								<div class="entry-content">
									<?php
										the_content( sprintf(
											/* translators: %s: Name of current post. */
											wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'faq-u' ), array( 'span' => array( 'class' => array() ) ) ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										) );

										wp_link_pages( array(
											'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'faq-u' ),
											'after'  => '</div>',
										) );
									?>
								</div><!-- .entry-content -->

								<footer class="entry-footer">
									<?php faq_u_entry_footer(); ?>
								</footer><!-- .entry-footer -->
	</article> <!-- end item -->

    <?php endwhile;  ?>
    </div> <!-- end isotope-list -->
<?php endif; ?>



	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
