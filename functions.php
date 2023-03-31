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
      'supports' => array('title', 'thumbnail'),
      'menu_position' => 5,
      'menu_icon' => 'dashicons-admin-customizer'
    );
    register_post_type('games', $args);
}

add_action('init', 'game_register_post_type');

function wp_remove_meta_box(){
    remove_meta_box('slugdiv', 'games', 'normal');
}

add_action('admin_menu', 'wp_remove_meta_box');

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
    $value = get_post_meta( $post->ID, '_game_name', true );
    echo '<input type="text" name="game_name" value='. esc_attr( $value ) . '>';
}

function add_game_date_meta_box(){
    add_meta_box(
        'game_date_meta_box', // Unique ID
        'Date de Sortie', // Box title
        'game_date_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_date_meta_box' );

function game_date_meta_box_function( $post ) {
    wp_nonce_field( 'game_date_meta_box', 'game_date_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_date', true );
    echo '<input type="text" name="game_date" value='. esc_attr( $value ) . '>';
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
    $value = get_post_meta( $post->ID, '_game_price', true );
    echo '<input type="number" name="game_price" value='. esc_attr( $value ) . '>';
}

function add_game_time_meta_box(){
    add_meta_box(
        'game_time_meta_box', // Unique ID
        'Temps de Jeu', // Box title
        'game_time_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}

add_action( 'add_meta_boxes', 'add_game_time_meta_box' );

function game_time_meta_box_function( $post ) {
    wp_nonce_field( 'game_time_meta_box', 'game_time_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_time', true );
    echo '<input type="text" name="game_time" value=' . esc_attr( $value ) . '>';
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
    $value = get_post_meta( $post->ID, '_game_nb_player', true );
    echo '<input type="number" name="game_nb_player" value='. esc_attr( $value ) . '>';
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
    $value = get_post_meta( $post->ID, '_game_content', true );
    echo '<textarea rows="5" cols="50" name="game_content">' . esc_attr( $value ) . '</textarea>';
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

function save_game_name_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_name_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_name_meta_box_nonce'], 'game_name_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_name'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_name'] );
    update_post_meta( $post_id, '_game_name', $my_data );
}

add_action( 'save_post', 'save_game_name_meta_box_data' );

function save_game_date_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_date_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_date_meta_box_nonce'], 'game_date_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_date'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_date'] );
    update_post_meta( $post_id, '_game_date', $my_data );
}

add_action( 'save_post', 'save_game_date_meta_box_data' );

function save_game_price_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_price_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_price_meta_box_nonce'], 'game_price_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_price'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_price'] );
    update_post_meta( $post_id, '_game_price', $my_data );
}

add_action( 'save_post', 'save_game_price_meta_box_data' );

function save_game_time_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_time_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_time_meta_box_nonce'], 'game_time_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_time'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_time'] );
    update_post_meta( $post_id, '_game_time', $my_data );
}

add_action( 'save_post', 'save_game_time_meta_box_data' );

function save_game_nb_player_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_nb_player_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_nb_player_meta_box_nonce'], 'game_nb_player_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_nb_player'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_nb_player'] );
    update_post_meta( $post_id, '_game_nb_player', $my_data );
}

add_action( 'save_post', 'save_game_nb_player_meta_box_data' );

function save_game_content_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_content_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_content_meta_box_nonce'], 'game_content_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_content'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_content'] );
    update_post_meta( $post_id, '_game_content', $my_data );
}

add_action( 'save_post', 'save_game_content_meta_box_data' );