<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Lyndascore
 */

if ( ! function_exists( 'lyndascore_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lyndascore_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'lyndascore' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'lyndascore' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline">Written by' .  $byline . '</span><span class="posted-on"> ' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'lyndascore_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function lyndascore_entry_footer() {
	// Hide category and tag text for pages.
//	if ( 'post' === get_post_type() ) {
//		/* translators: used between list items, list is comma separated */
//		$categories_list = get_the_category_list( esc_html__( ', ', 'lyndascore' ) );
//		if ( $categories_list && lyndascore_categorized_blog() ) {
//			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'lyndascore' ) . '</span>', $categories_list ); // WPCS: XSS OK.
//		}
//
//		/* translators: used between list items, there is a space after the comma */
//		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'lyndascore' ) );
//		if ( $tags_list ) {
//			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'lyndascore' ) . '</span>', $tags_list ); // WPCS: XSS OK.
//		}
//	}
//
//	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
//		echo '<span class="comments-link">';
//		comments_popup_link( esc_html__( 'Leave a comment', 'lyndascore' ), esc_html__( '1 Comment', 'lyndascore' ), esc_html__( '% Comments', 'lyndascore' ) );
//		echo '</span>';
//	}

    $tags_list = get_the_tag_list( '<li><i class="fa fa-tag"></i>', __( '</li><li><i class="fa fa-tag"></i>', 'lyndascore' ) );
    if ( $tags_list ) {
        printf( '<ul>' . __( '%1$s', 'lyndascore' ) . '</li></ul>', $tags_list );
    }

	edit_post_link( esc_html__( 'Edit', 'lyndascore' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function lyndascore_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'lyndascore_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'lyndascore_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so lyndascore_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so lyndascore_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in lyndascore_categorized_blog.
 */
function lyndascore_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'lyndascore_categories' );
}
add_action( 'edit_category', 'lyndascore_category_transient_flusher' );
add_action( 'save_post',     'lyndascore_category_transient_flusher' );


/**
 * Social Media icon menu - Justin Tadlock
 * This gets called in the header.php
 * Use this process for adding menus anywhere - ie in the footer
 */
function swp_social_menu(){
    if(has_nav_menu('social')){
        wp_nav_menu(
            array(
                'theme_location'=> 'social',
                'container' => 'div',
                'container_id' => 'menu-social',
                'container_class' => 'menu-social',
                'menu_id' => 'menu-social-items',
                'menu_class' => 'menu-items',
                'depth' => 1,
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
                'fallback_cb' => '',
            )
        );
    }
}
