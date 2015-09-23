<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lyndascore
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <!-- print out categories-->
        <?php

        //get the current category of the blog post and comma seperate it
        $categories_list = get_the_category_list( esc_html__( ', ', 'lyndascore' ) );

        //tests to see if there is more than one category
        if ( $categories_list && lyndascore_categorized_blog() ) {
            printf( '<div class="category-list">' . esc_html__( 'Posted in %1$s', 'lyndascore' ) . '</div>', $categories_list ); // WPCS: XSS OK.
        }

        ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php

                lyndascore_posted_on();
                //link for comments
            	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            		echo '<span class="comments-link">';

            		comments_popup_link(
                        esc_html__(
                            ' Leave a comment',
                            'lyndascore' ),
                        esc_html__( ' 1 Comment',
                            'lyndascore' ),
                        esc_html__( ' % Comments',
                            'lyndascore' )
                    );

            		echo '</span>';
            	}
            ?>


		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lyndascore' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php lyndascore_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

