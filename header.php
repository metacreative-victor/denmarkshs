<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	
	<?php
	$favicon = get_field( 'favicon', 'option' );

	if( !empty( $favicon ) && !empty( $favicon['url'] ) && !empty( $favicon['mime_type'] ) ) {
		echo '<link rel="shortcut icon" href="' .esc_url( $favicon['url'] ). '" type="' .esc_attr( $favicon['mime_type'] ). '">';
	}
	?>
	
	<?php wp_head(); ?>

	<?php
	$tracking_code = get_field( 'header_code', 'option' );

	if( !empty( $tracking_code ) ) {
		echo $tracking_code;
	}
	?>
</head>

<body <?php body_class(); ?>>
	<!-- SITE HEADER -->
    <header id="site-header">
        <div class="container">
			<a href="<?php echo home_url('/'); ?>" class="logo">
				<!--<img src="<?php //echo SEN_THEME_URL; ?>assets/images/logo.png" alt="logo" width="200" height="70">-->
				<img src="<?php echo SEN_THEME_URL; ?>assets/images/logo-20-years.png" alt="logo" width="300" height="64">
			</a>
			<!-- .logo -->

			<div class="header-menu">
				<?php
				if( has_nav_menu('secondary') ) {
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'menu_class' => 'menu',
						'container' => '',
						'link_before' => '<strong>',
                        'link_after' => '</strong>',
					));
				}
				?>
			</div>
			<!-- .header-menu -->

			<div class="header-buttons">
				<a href="#"><strong>For Parents</strong></a>
				<a href="#"><strong>For Students</strong></a>
			</div>
			<!-- .header-buttons -->
		</div>
		<!-- .container -->
    </header>
	<!-- END SITE HEADER -->

	<!-- SITE MENU -->
	<nav id="site-menu">
		<div class="container">
			<?php
			if( has_nav_menu('primary') ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class' => 'menu',
					'container' => '',
					'walker' => new Meta_Walker_Nav_Menu()
				));
			}
			?>
		</div>
		<!-- .container -->
	</nav>
	<!-- END SITE MENU -->