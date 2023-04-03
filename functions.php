<?php
function wp_enqueue_assets() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-header', get_stylesheet_directory_uri() . '/css/header.css', array( 'parent-style' ) );
    wp_enqueue_style( 'child-footer', get_stylesheet_directory_uri() . '/css/footer.css' , array( 'parent-style' ));
    wp_enqueue_style( 'child-main', get_stylesheet_directory_uri() . '/css/main.css' , array( 'parent-style' ));
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_assets' );

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
        'game_info_meta_box', // Unique ID
        'Information du Jeux', // Box title
        'game_info_meta_box_function', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );

}

add_action( 'add_meta_boxes', 'add_game_description_meta_box' );

function game_info_meta_box_function( $post ) {
    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_name', true );
    echo '<p>Nom du Jeu</p><input type="text" name="game_description" value="' . esc_attr( $value ) . '"/>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_year', true );
    echo '<p>Année de Sortie</p><input type="number" name="game_year" value="' . esc_attr( $value ) . '"/>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_price', true );
    echo '<p>Price</p><input type="number" name="game_price" value="' . esc_attr( $value ) . '"/>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_date', true );
    echo '<p>Date de Sortie</p><input type="text" name="game_date" value="' . esc_attr( $value ) . '"/>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_time', true );
    echo '<p>Temps de Jeux</p><input type="text" name="game_time" value="' . esc_attr( $value ) . '"/>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_nb_player', true );
    echo '<p>Nombre de Joueur</p><input type="number" name="game_nb_player" value="' . esc_attr( $value ) . '"/>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_content', true );
    echo '<p>Contenue de la Boite</p><textarea rows="5" cols="50" name="game_content">' . esc_attr( $value ) . '</textarea>';

    wp_nonce_field( 'game_info_meta_box', 'game_info_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_description', true );
    echo '<p>Description</p><textarea rows="5" cols="50" name="game_description">' . esc_attr( $value ) . '</textarea>';
}

function game_name_meta_box_function( $post ) {
    wp_nonce_field( 'game_name_meta_box', 'game_name_meta_box_nonce' );
    $value = get_post_meta( $post->ID, '_game_name', true );
    echo '<input type="text" name="game_name" value=' . esc_attr( $value ) . '/>';
}



function save_game_info_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_info_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_info_meta_box_nonce'], 'game_description_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['game_info'] ) ) {
        return;
    }
    $my_data = sanitize_textarea_field( $_POST['game_info'] );
    update_post_meta( $post_id, '_game_info', $my_data );
}

add_action( 'save_post', 'save_game_info_meta_box_data' );

function games_taxonomy(){
    $labels = array(
        'name'          => _x('Catégories de Jeux', 'taxonomy general name'),
        'singular_name' => _x('Categorie de Jeux', 'taxonomy general name'),
        'search_items'  => __('Rechercher une Catégories'),
        'all_items'     => __('Toutes les Catégories'),
        'update_item'   => __('Mettre à jour une Catégories'),
        'add_item'      => __('Ajouter une nouvelle Catégorie'),
        'new_item_name' => __('Nom de la Nouvelle Catégorie'),
        'not_found'     => __('Catégory Non Trouver'),
        'menu_name'     => __('Catégorie de Jeux')
    );
    $args_category_jeu = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'			=> true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'categories-jeux' ),

    );
    register_taxonomy( 'categories_jeux', 'games', $args_category_jeu );

    $labels_categ_type = array(
        'name'          => _x('Catégories de Types de Jeux', 'taxonomy general name'),
        'singular_name' => _x('Categorie de Type de Jeux', 'taxonomy general name'),
        'search_items'  => __('Rechercher une Catégories'),
        'all_items'     => __('Toutes les Catégories'),
        'update_item'   => __('Mettre à jour une Catégories'),
        'add_item'      => __('Ajouter une nouvelle Catégorie'),
        'new_item_name' => __('Nom de la Nouvelle Catégorie'),
        'not_found'     => __('Catégory Non Trouver'),
        'menu_name'     => __('Catégorie de Jeux')
    );
    $args_category_type = array(
        'hierarchical'          => true,
        'labels'                => $labels_categ_type,
        'show_ui'               => true,
        'show_in_rest'			=> true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'categories-jeux' ),

    );
    register_taxonomy( 'categories_games_type', 'games', $args_category_type );

    $labels_categ_thematique = array(
        'name'          => _x('Catégories de Thématiques', 'taxonomy general name'),
        'singular_name' => _x('Categorie de Thématique', 'taxonomy general name'),
        'search_items'  => __('Rechercher une Catégories'),
        'all_items'     => __('Toutes les Catégories'),
        'update_item'   => __('Mettre à jour une Catégories'),
        'add_item'      => __('Ajouter une nouvelle Catégorie'),
        'new_item_name' => __('Nom de la Nouvelle Catégorie'),
        'not_found'     => __('Catégory Non Trouver'),
        'menu_name'     => __('Catégorie de Jeux')
    );
    $args_category_thematique = array(
        'hierarchical'          => true,
        'labels'                => $labels_categ_thematique,
        'show_ui'               => true,
        'show_in_rest'			=> true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'categories-jeux' ),

    );
    register_taxonomy( 'categories_games_thematique', 'games', $args_category_thematique );
}

add_action('init', 'games_taxonomy', 0);

// Meta Box Image
function add_game_image_meta_box() {
    add_meta_box(
        'game_image_meta_box', // Unique ID
        'Image du Jeu', // Box title
        'game_image', // Content callback
        'games', // Post type
        'normal', // Position
        'high' // Priority
    );
}
add_action( 'add_meta_boxes', 'add_game_image_meta_box' );

function game_image( $post ) {
    wp_nonce_field( 'game_image_meta_box', 'game_image_meta_box_nonce' );
    $image = get_post_meta( $post->ID, '_game_image', true );
    echo '<input type="button" id="game_image_upload_button" class="button" value="' . __( 'Upload Image', 'textdomain' ) . '">';
    echo '<input type="hidden" id="game_image" name="game_image" value="' . esc_attr( $image ) . '">';
    if ( $image ) {
        echo '<div id="game_image_preview"><img src="' . esc_attr( $image ) . '"></div>';
    } else {
        echo '<div id="game_image_preview"></div>';
    }
}

function save_game_image_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['game_image_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['game_image_meta_box_nonce'], 'game_image_meta_box' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['game_image'] ) ) {
        update_post_meta( $post_id, '_game_image', esc_url_raw( $_POST['game_image'] ) );
    }
}
add_action( 'save_post', 'save_game_image_meta_box_data' );

function game_image_enqueue_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'game-image-upload', get_stylesheet_directory_uri() . '/js/game-image-upload.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'game_image_enqueue_scripts' );

