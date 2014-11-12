<?php

if ( ! function_exists( 'bemainty_paging_nav' ) ) :
function bemainty_paging_nav() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
    	<div class="post-nav-box clear">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'bemainty' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bemainty' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bemainty' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bemainty_post_nav' ) ) :
function bemainty_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'bemainty' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'bemainty' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'bemainty' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bemainty_posted_on' ) ) :
function bemainty_posted_on() {
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

    $categories_list = get_the_category_list( __( ' ', 'bemainty' ) );
		if ( $categories_list && bemainty_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'In %1$s', 'bemainty' ) . '</span>', $categories_list );
		}

	$posted_on = sprintf(
		_x( '- %s', 'post date', 'bemainty' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'bemainty' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>';
    
    	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'bemainty' ), __( '1 Comment', 'bemainty' ), __( '% Comments', 'bemainty' ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'bemainty_entry_footer' ) ) :
function bemainty_entry_footer() {
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		        
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ' ', 'bemainty' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'bemainty' ) . '</span>', $tags_list );
		}
	}



	edit_post_link( __( 'Edit', 'bemainty' ), '<span class="edit-link">', '</span>' );
}
endif;

function bemainty_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bemainty_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bemainty_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}

function bemainty_category_transient_flusher() {
	delete_transient( 'bemainty_categories' );
}
add_action( 'edit_category', 'bemainty_category_transient_flusher' );
add_action( 'save_post',     'bemainty_category_transient_flusher' );


function bemainty_social_menu() {
    if ( has_nav_menu( 'social' ) ) {
	 wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu-social',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
            'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);
    }
}
