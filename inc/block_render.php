<?php

function mo_optins_dynamic_render_callback( $block_attributes, $content ) {

    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => 1,
        'post_status' => 'publish',
    ) );

    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }

    $post = $recent_posts[ 0 ];
    $post_id = $post['ID'];
    $style = "text-align:".$block_attributes['textAlign'];
    return sprintf(
        
        '<p style="%3$s"><a class="wp-block-mo-option-plugin-latest-post" href="%1$s">%2$s</a></p>',
        esc_url( get_permalink( $post_id ) ),
        esc_html( get_the_title( $post_id ) ),
        $style
    );
}