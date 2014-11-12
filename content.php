<?php
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	
		<div class="entry-meta">
			<?php bemainty_posted_on(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	
	    <?php 
            if (has_post_thumbnail()) {
                echo '<div class="single-post-thumbnail clear">';
                echo the_post_thumbnail('index-thumb');
                echo '</div>';
            }
        ?>
		<?php

			the_excerpt();
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
