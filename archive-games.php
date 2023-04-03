<?php get_header();

// $field = array('name','year','date','price','nb_player','time','content','description');
// var_dump(count($field));
// for ($i = 0; $i < count($field); $i++){
//     echo $field[$i];
// }
// ?>
<main class="site__recipe">
<?php get_template_part( 'block', 'article' ); ?>
<h1 class="site__heading">
    <?php post_type_archive_title(); ?>
</h1>
            <div class="card-games">
                <div class="body-card">
                    <div class="picture-card">
                        <img src="./img/pagnan.jpg" alt="pagnan">
                    </div>
                    <div class="container-card">
                        <p class="text-card">Pagnan: Le Destin De Roanoke :</p>
                        <p class="text-card">2023</p>
                    </div>
                </div>

                <div class="body-card">
                    <div class="picture-card">
                        <img src="./img/pagnan.jpg" alt="pagnan">
                    </div>
                    <div class="container-card">
                        <p class="text-card">Pagnan: Le Destin De Roanoke :</p>
                        <p class="text-card">2023</p>
                    </div>
                </div>

                <div class="body-card">
                    <div class="picture-card">
                        <img src="./img/pagnan.jpg" alt="pagnan">
                    </div>
                    <div class="container-card">
                        <p class="text-card">Pagnan: Le Destin De Roanoke :</p>
                        <p class="text-card">2023</p>
                    </div>
                </div>

                <div class="body-card">
                    <div class="picture-card">
                        <img src="./img/pagnan.jpg" alt="pagnan">
                    </div>
                    <div class="container-card">
                        <p class="text-card">Pagnan: Le Destin De Roanoke :</p>
                        <p class="text-card">2023</p>
                    </div>
                </div>

            </div>
        <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
        <?php endwhile;
    endif; ?>
</main>
<?php the_posts_pagination(); ?>
<?php get_footer(); ?>
