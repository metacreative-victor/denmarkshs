<?php 
/**
 * Template name: Fullwidth
 */

get_header(); ?>

<!-- CONTENT -->
<main id="site-content">
	<?php while( have_posts() ) : the_post(); ?>
        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
            <!-- .container -->
        </div>
        <!-- .page-header -->

		<div class="content-wide">
			<div class="content container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
			<!-- .content -->
		</div>
		<!-- .container -->
	<?php endwhile; ?>
</main>
<!-- END CONTENT -->

<?php get_footer(); ?>