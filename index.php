<?php get_header(); ?>

<!-- CONTENT -->
<main id="site-content">
	<?php get_template_part('template-parts/_page-header'); ?>

	<div class="content-wide">
		<div class="content container">
			<?php
			$featured_news = get_field( 'featured_news', 'option' );

			if( !empty( $featured_news ) ) {
				echo '<h3 class="news-heading">Featured News</h3>';
				
				echo '<div class="featured-post">';
					if( has_post_thumbnail( $featured_news ) ) {
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $featured_news ), 'large' );
						if( $thumbnail[0] ) {
							echo '<div class="featured-post__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');"></div>';
						}
					}
					echo '<div class="featured-post__content">';
						echo '<p class="featured-post__title"><a href="' .get_permalink( $featured_news ). '">' .get_the_title( $featured_news ). '</a></p>';
						echo wpautop( get_the_excerpt( $featured_news ) );
						echo '<a href="' .get_permalink( $featured_news ). '" class="button button-primary">Read</a>';
					echo '</div>';
				echo '</div><!-- .featured-post -->';
			}
			?>

			<h3 class="news-heading">All News</h3>
			<?php 
			if( have_posts() ) :
				echo '<div class="row post-grid">';
					set_query_var('_enable_excerpt', true);
					while( have_posts() ) : the_post();
						get_template_part('template-parts/loop-post');
					endwhile;
				echo '</div>';

				the_posts_pagination();
			endif;
			?>
		</div>
		<!-- .content -->
	</div>
	<!-- .container -->
</main>
<!-- END CONTENT -->

<?php get_footer(); ?>