<?php

get_header();

$args = array(
    'numberposts' => 1000,
    'post_type'   => 'games',
    'order'       => 'ASC',
    'orderby'     => 'title'
);
$games = get_posts( $args );
var_dump($games);
?>
<main>
<?php get_template_part( 'block', 'article' ); 
if ($games) : ?>
    <ul>
        <?php foreach ( $games as $game ) : setup_postdata( $game ); ?>
            <li>
                <img style="width: 5rem" src="<?= get_post_meta($game->ID, '_game_image')[0] ?>">
                <a href="<?= $game->guid ?>"><?= $game->post_title; ?></a>
            </li>
        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
<?php endif; ?>
</main>
<?php
get_footer();
