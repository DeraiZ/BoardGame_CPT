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


function add_game_description_meta_box() {
    add_meta_box(
        'game_description_meta_box', // Unique ID
        'Description', // Box title
        'game_description_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}
add_action( 'add_meta_boxes', 'add_game_description_meta_box' );

function game_description_meta_box_function( $post ) {
    wp_nonce_field( 'game_description_meta_box', 'game_description_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<textarea rows="5" cols="50" name="game_description">' . esc_attr( $value ) . '</textarea>';
}

function add_game_name_meta_box(){
    add_meta_box(
        'game_name_meta_box', // Unique ID
        'Nom du Jeu', // Box title
        'game_name_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_name_meta_box' );

function game_name_meta_box_function( $post ) {
    wp_nonce_field( 'game_name_meta_box', 'game_name_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<input type="text" name="game_name"/>';
}

function add_game_edition_date_meta_box(){
    add_meta_box(
        'game_edition_date_meta_box', // Unique ID
        'Date de Sortie', // Box title
        'game_edition_date_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_edition_date_meta_box' );

function game_edition_date_meta_box_function( $post ) {
    wp_nonce_field( 'game_price_meta_box', 'game_price_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<input type="text" name="game_date"/>';
}

function add_game_price_meta_box(){
    add_meta_box(
        'game_price_meta_box', // Unique ID
        'Prix', // Box title
        'game_price_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_price_meta_box' );

function game_price_meta_box_function( $post ) {
    wp_nonce_field( 'game_price_meta_box', 'game_price_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<input type="number" name="game_date" />';
}

function add_game_game_time_meta_box(){
    add_meta_box(
        'game_game_time_meta_box', // Unique ID
        'Temps de Jeu', // Box title
        'game_game_time_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_game_time_meta_box' );

function game_game_time_meta_box_function( $post ) {
    wp_nonce_field( 'game_game_time_meta_box', 'game_game_time_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<input type="text" name="game_date" />';
}

function add_game_nb_player_meta_box(){
    add_meta_box(
        'game_nb_player_meta_box', // Unique ID
        'Nombre de Joueur', // Box title
        'game_nb_player_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_nb_player_meta_box' );

function game_nb_player_meta_box_function( $post ) {
    wp_nonce_field( 'game_nb_player_meta_box', 'game_nb_player_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<input type="text" name="game_date" />';
}

function add_game_content_meta_box(){
    add_meta_box(
        'game_content_meta_box', // Unique ID
        'Contenu de la Boite', // Box title
        'game_content_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_content_meta_box' );

function game_content_meta_box_function( $post ) {
    wp_nonce_field( 'game_content_meta_box', 'game_content_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<textarea rows="5" cols="50" name="game_description">' . esc_attr( $value ) . '</textarea>';
}

function save_game_description_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_description_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_description_meta_box_nonce'], 'game_description_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_description'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_description'] );
    update_post_meta( $post_id, '_game_description', $my_data );
}
add_action( 'save_post', 'save_game_description_meta_box_data' );
