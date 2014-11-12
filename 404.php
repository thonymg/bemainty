<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'bemainty' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<?php get_search_form(); ?>

                
                    <h1 class="page-title"><?php _e( 'Try with another words .', 'bemainty' ); ?></h1>
					
					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
