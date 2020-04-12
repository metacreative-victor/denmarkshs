<?php
$title = get_the_title();

if( is_home() || is_front_page() ) {
    $title = 'Latest News';
}
?>
<div class="page-header">
    <div class="container">
        <?php
        if( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
        <h1><?php echo $title; ?></h1>
        <?php
        $thumbnail_id = get_field('default_image', 'option');

        if( has_post_thumbnail() ) {
            $thumbnail_id = get_post_thumbnail_id();
        }

        $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'large' );
            
        if( $thumbnail[0] ) {
            echo '<div class="page-header__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');"></div>';
        }
        ?>
    </div>
    <!-- .container -->
</div>
<!-- .page-header -->