<?php
add_shortcode( 'meta_files', 'shortcode_meta_files' );
function shortcode_meta_files( $params ) {
	extract( shortcode_atts( array(
    ), $params ));

    if( !is_page() ) {
        return;
    }

    global $post;
    $post_id = $post->ID;

    if( have_rows('files', $post_id) ) {
        $return = '<ul class="menu files">';
            while( have_rows('files', $post_id) ) {
                the_row();

                $title = get_sub_field( 'title' );
                $file = get_sub_field( 'file' );
                $file_url = get_sub_field( 'file_url' );
                if( empty( $file ) ) {
                    $file = $file_url;
                }
                $return .= '<li><a href="' .esc_url( $file ). '" target="_blank">' .$title. '</a></li>';

            }
        $return .= '</ul>';
        return $return;
    }
}

add_shortcode( 'meta_leadership', 'shortcode_meta_leadership' );
function shortcode_meta_leadership( $params ) {
	extract( shortcode_atts( array(
    ), $params ));

    if( !is_page() ) {
        return;
    }

    global $post;
    $post_id = $post->ID;

    if( have_rows('members', $post_id) ) {
        $output = '<ul class="menu members">';
            while( have_rows('members', $post_id) ) {
                the_row();
                $photo = get_sub_field('photo');
                $name = get_sub_field('name');
                $title = get_sub_field('title');
                $output .= '<li>';
                    if( !empty( $photo ) ) {
                        $member_photo = wp_get_attachment_image_src( $photo, 'thumbnail' );
                        if( $member_photo[0] ) {
                            $output .= '<div class="member__photo" style="background-image: url(' .esc_url( $member_photo[0] ). ');"></div>';
                        }
                    }
                    $output .= '<p><strong>' .$title. '</strong></p>';
                    $output .= '<p>' .$name. '</p>';
                $output .= '</li>';
            }
        $output .= '</ul>';
        return $output;
    }
}

add_shortcode( 'meta_year_coordinators', 'shortcode_meta_year_coordinators' );
function shortcode_meta_year_coordinators( $params ) {
	extract( shortcode_atts( array(
    ), $params ));

    if( !is_page() ) {
        return;
    }

    global $post;
    $post_id = $post->ID;

    if( have_rows('year_coordinators', $post_id) ) {
        $output = '<ul class="menu year-coordinators">';
            while( have_rows('year_coordinators', $post_id) ) {
                the_row();
                $name = get_sub_field('name');
                $title = get_sub_field('title');
                $output .= '<li>';
                    $output .= '<p><strong>' .$title. '</strong></p>';
                    $output .= '<p>' .$name. '</p>';
                $output .= '</li>';
            }
        $output .= '</ul>';
        return $output;
    }
}

add_shortcode( 'meta_cta', 'shortcode_meta_cta' );
function shortcode_meta_cta( $params ) {
	extract( shortcode_atts( array(
    ), $params ));

    if( !is_page() ) {
        return;
    }

    global $post;
    $post_id = $post->ID;

    if( have_rows('ctas', $post_id) ) {
        $output = '<div class="row cta-items">';
            while( have_rows('ctas', $post_id) ) {
                the_row();
                $photo = get_sub_field('photo');
                $title = get_sub_field('title');
                $link = get_sub_field('link');
                $button = get_sub_field('button');
                $output .= '<div class="col-md-4">';
                    $output .= '<div class="cta-item" style="background-image: url(' .($photo['sizes']['large'] ? $photo['sizes']['large'] : ''). ');">';
                        $output .= '<a href="' .esc_url( $link ). '" class="cta-item__link"></a>';
                        $output .= '<p class="cta-item__title">' .$title. '</p>';
                        $output .= '<a href="' .esc_url( $link ). '" class="button button-primary">' .$button. '</a>';
                    $output .= '</div><!-- .cta-item -->';
                $output .= '</div>';
            }
        $output .= '</div>';
        return $output;
    }
}

add_shortcode( 'meta_accordions', 'shortcode_meta_accordions' );
function shortcode_meta_accordions( $params ) {
	extract( shortcode_atts( array(
        'id' => null
    ), $params ));

    if( !is_page() ) {
        return;
    }

    global $post;
    $post_id = $post->ID;

    $accordions = get_field( 'accordions', $post_id );
    $id = intval( $id ) - 1;

    if( !empty( $accordions ) ) {
        if( isset( $accordions[$id] ) && !empty( $accordions[$id]['items'] ) ) {
            $output = '<div class="block-accordions">';
                foreach( $accordions[$id]['items'] as $item ) {
                    if( !empty( $item['heading'] ) && !empty( $item['content'] ) ) {
                        $output .= '<a class="block-accordion--toggler collapsed" data-toggle="collapse" href="#collapse-' .sanitize_title( $item['heading'] ). '">' .$item['heading']. '</a>';
                        $output .= '<div class="collapse" id="collapse-' .sanitize_title( $item['heading'] ). '">';
                            $output .= '<div class="block-accordion--text">';
                                $output .= wpautop( $item['content'] );
                            $output .= '</div>';
                        $output .= '</div><!-- .collapse -->';
                    }
                }
            $output .= '</div><!-- .block-accordions -->';

            return $output;
        }
    }
}

add_shortcode( 'meta_subpages', 'shortcode_meta_subpages' );
function shortcode_meta_subpages( $params ) {
	extract( shortcode_atts( array(
        'id' => null
    ), $params ));

    if( empty( $id ) ) {
        global $post;
        $id = $post->ID;
    }

    $childs = get_pages( array(
        'child_of' => $id,
        'parent' => $id,
        'hierarchical' => 1,
        'sort_order' => 'asc',
        'sort_column' => 'post_title'
    ));

    if( !empty( $childs ) ) {
        $output = '<ul class="menu subpages">';
            foreach( $childs as $i ) {
                $output .= '<li><a href="' .get_permalink( $i->ID ). '">' .get_the_title( $i->ID ). '</a></li>';
            }
        $output .= '</ul>';

        return $output;
    }
}