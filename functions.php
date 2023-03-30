<?php

function wp_enqueue_assets(){
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . 'style.css'
    );
}

add_action('wp_enqueue_scripts', 'wp_enqueue_assets');