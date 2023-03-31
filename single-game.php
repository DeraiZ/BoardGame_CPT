<?php
$description = get_post_meta( get_the_ID(), '_game_description', true );
if ( ! empty( $description ) ) {
    echo '<p>' . esc_html( $description ) . '</p>';
}
?>