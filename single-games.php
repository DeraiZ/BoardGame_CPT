<?php
get_header();

$type = wp_get_object_terms(get_the_ID(), 'categories_games_type');
$games = wp_get_object_terms(get_the_ID(), 'categories_jeux');
$them = wp_get_object_terms(get_the_ID(), 'categories_games_thematique');

?>
<main>
<section class="detail-block">
    <div class="detail-block-container">
        <div class="detail-block-image">
            <?php
            $image = get_post_meta( get_the_ID(), '_game_image', true );
            if ( ! empty( $image ) ) {
                echo '<img class="picture-details" src="' . esc_html( $image ) . '"/>';
            }
            ?>
        </div>
        <div class="detail-block-content">
            <div class="details-block-name-year">
                <div class="details-block-name">
                <?php
                $name = get_post_meta( get_the_ID(), '_game_name', true );
                if ( ! empty( $name ) ) {
                    echo '<h1 class="details-block-name-title">' . esc_html( $name ) . '</h1>';
                }
                ?>
                </div>
                <div class="details-block-year">
                    <?php
                    $year = get_post_meta( get_the_ID(), '_game_year', true );
                    if ( ! empty( $year ) ) {
                        echo '<p>' . esc_html( $year ) . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="details-block-info">
                <div class="details-block-date">
                    <p>Sortie le :</p>
                    <?php
                    $date = get_post_meta( get_the_ID(), '_game_date', true );
                    if ( ! empty( $date ) ) {
                        echo '<p>' . esc_html( $date ) . '</p>';
                    }
                    ?>
                </div>
                <div class="details-block-price">
                    <p>Prix :</p>
                    <?php
                    $price = get_post_meta( get_the_ID(), '_game_price', true );
                    if ( ! empty( $price ) ) {
                        echo '<p>' . esc_html( $price ) . '€</p>';
                    }
                    ?>
                </div> 
                <div class="details-block-time">
                    <p>Temps de jeu :</p>
                    <?php
                    $time = get_post_meta( get_the_ID(), '_game_time', true );
                    if ( ! empty( $time ) ) {
                        echo '<p>' . esc_html( $time ) . '</p>';
                    }
                    ?>
                </div>
                <div class="details-block-player">
                    <p>Nbr de joueurs :</p>
                    <?php
                    $nbplayer = get_post_meta( get_the_ID(), '_game_nb_player', true );
                    if ( ! empty( $nbplayer ) ) {
                        echo '<p>' . esc_html( $nbplayer ) . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="details-block-category">
                <?php
                for ($i=0; $i < count($type); $i++){
                    $categories_games_type = $type[$i]->name;
                    $categories_games = $games[$i]->name;
                    $categories_games_them = $them[$i]->name;
                
                    if ( ! empty( $categories_games_type ) ) {
                        echo '<p class="category-type">' . esc_html( $categories_games_type ) . '</p>';
                        echo '<p class="category-étiquettes">' . esc_html( $categories_games ) . '</p>';
                        echo '<p class="category-taxonomie">' . esc_html( $categories_games_them ) . '</p>';
                    }
                }
                
                 ?>
            </div>
        </div>
    </div>
    <div class="details-block-content-description">
        <div class="details-block-content">
            <p class="details-block-titre">Contenu :</p>
            <?php
            $content = get_post_meta( get_the_ID(), '_game_content', true );
            if ( ! empty( $content ) ) {
                echo '<p>' . esc_html( $content ) . '</p>';
            }
            ?>
        </div>  
        <div class="details-block-description">
            <p class="details-block-titre">Description :</p>
            <?php
            $description = get_post_meta( get_the_ID(), '_game_description', true );
            if ( ! empty( $description ) ) {
                echo '<p>' . esc_html( $description ) . '</p>';
            }
            ?>
        </div>
    </div>
</section>

</main>

<?php
get_footer();
?>