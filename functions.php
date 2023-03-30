<?php

function wp_enqueue_assets(){
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . 'style.css'
    );
}

add_action('wp_enqueue_scripts', 'wp_enqueue_assets');

function game_register_post_type(){

    $labels = array(
        'name' => 'Jeux',
        'all_items' => 'Tous les jeux',
        'singular_name' => 'Jeu',
        'add_new_item' => 'Ajouter un Jeu',
        'edit_item' => 'Modifier le Jeu',
        'menu_name' => 'Jeux'
    );
    $args = array(
      'labels' => $labels,
      'public' => true,
      'show_in_rest' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'menu_position' => 5,
      'menu_icon' => 'dashicons-admin-customizer'
    );
    register_post_type('games', $args);
}

add_action('init', 'game_register_post_type');