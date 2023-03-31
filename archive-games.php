<?php get_header();

$field = array('name','year','date','price','nb_player','time','content','description');
var_dump(count($field));
for ($i = 0; $i < count($field); $i++){
    echo $field[$i];
}
?>
<h1 class="site__heading">
    <?php post_type_archive_title(); ?>
</h1>
<main class="site__recipe">
    <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="project">
                <h2 class="project__title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endwhile;
    endif; ?>
</main>
<?php the_posts_pagination(); ?>
<?php get_footer(); ?>
