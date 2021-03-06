<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Faq_U_Schule!
 */

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
