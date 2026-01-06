<?php
/*
function add_stylesheet_to_head() {
   // var_dump(get_stylesheet_uri()); die;
    //  echo "<link href='".get_stylesheet_uri()."' rel='stylesheet' type='text/css'>";
}

add_action( 'wp_head', 'add_stylesheet_to_head' );
*/  




function add_my_scripts() {
    wp_enqueue_script( 'jquery-script',  'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'add_my_scripts' );
