<?php

get_header();

$args = array(
    'numberposts' => 1000,
    'post_type'   => 'games',
    'order'       => 'ASC',
    'orderby'     => 'title'
);
$games = get_posts( $args );

?>
<main>
<?php get_template_part( 'block', 'article' ); 
if ($games) : ?>
    <ul>
        <?php foreach ( $games as $game ) : setup_postdata( $game ); ?>

            <li>
                <img style="width: 5rem" src="<?= get_post_meta($game->ID, '_game_image')[0] ?>">
                <a href="<?= $game->guid ?>"><?= $game->post_title; ?></a>
                <?php
                $taxo = wp_get_object_terms($game->ID, 'categories_games_type');
                for ($i=0; $i < count($taxo); $i++){ ?>
                    <p><?= wp_get_object_terms($game->ID, 'categories_games_type')[$i] -> name ?></p>
                    <p><?= wp_get_object_terms($game->ID, 'categories_jeux')[$i] -> name ?></p>
                    <p><?= wp_get_object_terms($game->ID, 'categories_games_thematique')[$i] -> name ?></p>

                <?php } ?>

            </li>
        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
<?php endif; ?>
</main>
<?php
get_footer();
