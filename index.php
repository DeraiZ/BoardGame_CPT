<?php

get_header();

$args = array(
    'numberposts' => 9,
    'post_type'   => 'games',
    'order'       => 'ASC',
    'orderby'     => 'title'
);
$games = get_posts( $args );
?>
<main>
    <?php if ($games) : ?>
    <ul>
        <?php foreach ( $games as $game ) : setup_postdata( $game ); ?>
            <li><a href="<?= $game->guid ?>"><?= $game->post_title; ?></a></li>
        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
<?php endif; ?>
</main>
<?php
get_footer();
