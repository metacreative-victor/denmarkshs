<?php
/**
* Template Name: Home
*/

get_header(); ?>

<!-- CONTENT -->
<main id="site-content">
	<?php while( have_posts() ) : the_post(); ?>

		<?php
		$welcome = get_field( 'welcome' );
		
		if( $welcome ) {
			echo '<section id="welcome">';
				echo '<div class="container">';
					if( !empty( $welcome['content'] ) ) {
						echo '<div class="welcome-text">' .wpautop( $welcome['content'] ). '</div>';	
					}
				echo '</div><!-- .container -->';
				if( !empty( $welcome['photo'] ) ) {
					$welcome_photo = wp_get_attachment_image_src( $welcome['photo'], 'large' );

					if( $welcome_photo[0] ) {
						echo '<div class="welcome-photo" style="background-image: url(' .esc_url( $welcome_photo[0] ). ');"></div>';
					}
				}
			echo '</section><!-- #welcome -->';
		}
		?>

		<?php
		$about = get_field( 'about' );

		if( $about ) {
			echo '<section id="about">';
				echo '<div class="container">';
					if( !empty( $about['heading'] ) ) {
						echo '<h2 class="about-heading">' .$about['heading']. '</h2>';
					}

					if( !empty( $about['content'] ) ) {
						echo wpautop( $about['content'] );
					}
				echo '</div><!-- .container -->';
			echo '</section><!-- #about -->';
		}
		?>

		<?php
		$mission = get_field( 'mission' );

		if( $mission ) {
			echo '<section id="mission">';
				echo '<div class="container">';
					if( !empty( $mission['content'] ) ) {
						echo '<div class="mission-text">' .wpautop( $mission['content'] ). '</div>';
					}
				echo '</div><!-- .container -->';
				if( !empty( $mission['photo'] ) ) {
					$mission_photo = wp_get_attachment_image_src( $mission['photo'], 'large' );

					if( $mission_photo[0] ) {
						echo '<div class="mission-photo" style="background-image: url(' .esc_url( $mission_photo[0] ). ');"></div>';
					}
				}
			echo '</section><!-- #mission -->';
		}
		?>

		<?php
		$news = get_field( 'news' );

		if( $news ) {
			$args = array();
			$args['post_type'] = 'post';
			$args['post_status'] = 'publish';
			$args['posts_per_page'] = 3;
			$the_query = new WP_Query($args);

			echo '<section id="news">';
				echo '<div class="container">';
					if( !empty( $news['heading'] ) ) {
						echo '<h2 class="text-center">' .$news['heading']. '</h2>';
					}
					if( $the_query->have_posts() ) {
						echo '<div class="row post-grid">';
							while( $the_query->have_posts() ) {
								$the_query->the_post();

								set_query_var( '_enable_excerpt', false );
								set_query_var( '_btn_text', 'Learn more' );
								get_template_part( 'template-parts/loop-post' );
							}
						echo '</div><!-- .row -->';
						wp_reset_postdata();
					}
				echo '</div><!-- .container -->';
			echo '</section><!-- #news -->';
		}
		?>
	<?php endwhile; wp_reset_postdata(); ?>
</main>
<!-- END CONTENT -->

<?php get_footer(); ?>