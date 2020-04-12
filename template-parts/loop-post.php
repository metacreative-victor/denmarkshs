<?php
$enable_excerpt = get_query_var( '_enable_excerpt', false );
$btn_text = get_query_var( '_btn_text', 'Read' );
?>
<div class="col-lg-4 col-md-6">
    <div class="post-item <?php echo $enable_excerpt ? 'has-excerpt' : 'no-excerpt'; ?>">
        <div class="post-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <?php
        if( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

            if( $thumbnail[0] ) {
                echo '<div class="post-item__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');"></div>';
            }
        }

        if( $enable_excerpt ) {
            the_excerpt();
        }
        ?>

        <a href="<?php the_permalink(); ?>" class="button button-primary"><?php echo $btn_text; ?></a>
    </div>
    <!-- .post-item -->
</div>