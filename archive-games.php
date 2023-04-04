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
<main class="site__recipe">
<?php get_template_part( 'block', 'article' ); 
if ($games) : ?>
            <div class="card-games">
            <?php foreach ( $games as $game ) : setup_postdata( $game ); ?>
                <div class="body-card">
                    <div class="picture-card">
                    <img src="<?= get_post_meta($game->ID, '_game_image')[0] ?>">
                    </div>
                    <div class="container-card">
                        <p class="text-card"><a href="<?= $game->guid ?>"><?= $game->post_title; ?></a></p>
                        <p class="text-card">2023</p>
                    </div>
                </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>

<?php endif; ?>
</main>
<?php the_posts_pagination(); ?>
<?php get_footer(); ?>
