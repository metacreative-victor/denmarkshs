<?php get_header(); ?>

<!-- CONTENT -->
<main id="site-content">
	<?php while( have_posts() ) : the_post(); ?>
		<?php get_template_part('template-parts/_page-header'); ?>

		<div class="content-sidebar">
			<div class="content container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
			<!-- .content -->
			<div class="sidebar">
				<div class="container">
					<h4>News & Events</h4>
					<?php
					wp_nav_menu( array(
						'menu' => 4,
						'menu_class' => 'menu',
						'container' => ''
					));
					?>
				</div>
				<!-- .container -->
			</div>
			<!-- .sidebar -->
		</div>
		<!-- .container -->
	<?php endwhile; ?>
</main>
<!-- END CONTENT -->

<?php get_footer(); ?>