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
					<?php
					global $post;
					$post_id = $post->ID;
					$parent_id = $post_id;
			
					if( !empty( $post->post_parent ) ) {
						$parent_id = wp_get_post_parent_id( $post->post_parent );
			
						if( !$parent_id ) {
							$parent_id = $post->post_parent;
						}
					}
			
					$pages = get_pages( array(
						'child_of' => $parent_id,
						'parent' => $parent_id,
						'hierarchical' => 0,
						'sort_order' => 'asc',
						'sort_column' => 'menu_order'
					));
			
					if( !empty( $pages ) ) {
						echo '<h4>' .get_the_title( $parent_id ). '</h4>';
						echo '<ul class="menu">';
						foreach( $pages as $item ) {
							$childs = get_pages( array(
								'child_of' => $item->ID,
								'parent' => $item->ID,
								'hierarchical' => 1,
								'sort_order' => 'asc',
								'sort_column' => 'menu_order'
							));
			
							echo '<li class="' .($item->ID == $post_id ? 'current-menu-item' : ''). '">';
								echo '<a href="' .get_permalink( $item->ID ). '">' .get_the_title( $item->ID ). '</a>';
							
								if( !empty( $childs ) ) {
									echo '<ul class="sub-menu">';
									foreach( $childs as $child ) {
										if( $child->ID == $post_id ) {
											echo '<li class="current-menu-item">';
										} else {
											echo '<li>';
										}
										echo '<a href="' .get_permalink( $child->ID ). '">' .get_the_title( $child->ID ). '</a></li>';
									}
									echo '</ul>';
								}
							echo '</li>';
						}
						echo '</ul>';
					}
					?>
				</div>
			</div>
			<!-- .sidebar -->
		</div>
		<!-- .container -->
	<?php endwhile; ?>
</main>
<!-- END CONTENT -->

<?php get_footer(); ?>