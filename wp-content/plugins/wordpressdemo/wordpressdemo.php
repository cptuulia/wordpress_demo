<?php

/*
Plugin Name: wordpressdemo
Plugin URI: 
Description: wordpressdemo Test
Author: Tantonius
Version: 1.7.2
Author URI: wordpressdemo
*/

class wordpressdemo {
    public function __construct() {
    
        add_shortcode('wordpressdemo',  [$this,'wordpressdemo_shortcode']);
    }



    /**
     * Shortcode: [wordpressdemo]
     * @return string
     */
    function wordpressdemo_shortcode() {
        return 'wordpressdemo test';
    }


}
new wordpressdemo();
