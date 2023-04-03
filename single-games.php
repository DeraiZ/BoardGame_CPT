<?php
get_header();

$name = get_post_meta( get_the_ID(), '_game_name', true );
if ( ! empty( $name ) ) {
    echo '<h1>' . esc_html( $name ) . '</h1>';
}
$year = get_post_meta( get_the_ID(), '_game_year', true );
if ( ! empty( $year ) ) {
    echo '<p>' . esc_html( $year ) . '</p>';
}
$date = get_post_meta( get_the_ID(), '_game_date', true );
if ( ! empty( $date ) ) {
    echo '<p>' . esc_html( $date ) . '</p>';
}
$price = get_post_meta( get_the_ID(), '_game_price', true );
if ( ! empty( $price ) ) {
    echo '<p>' . esc_html( $price ) . '</p>';
}
$time = get_post_meta( get_the_ID(), '_game_time', true );
if ( ! empty( $time ) ) {
    echo '<p>' . esc_html( $time ) . '</p>';
}
$nbplayer = get_post_meta( get_the_ID(), '_game_nb_player', true );
if ( ! empty( $nbplayer ) ) {
    echo '<p>' . esc_html( $nbplayer ) . '</p>';
}
$content = get_post_meta( get_the_ID(), '_game_content', true );
if ( ! empty( $content ) ) {
    echo '<p>' . esc_html( $content ) . '</p>';
}
$description = get_post_meta( get_the_ID(), '_game_description', true );
if ( ! empty( $description ) ) {
    echo '<p>' . esc_html( $description ) . '</p>';
}

$image = get_post_meta( get_the_ID(), '_game_image', true );
if ( ! empty( $image ) ) {
    echo '<img src="' . esc_html( $image ) . '"/>';
}
?>

<header>

</header>