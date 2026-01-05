<?php

/*
Plugin Name: worpressdemo
Plugin URI: worpressdemo
Description: worpressdemo Test
Author: 
Version: 1.7.2
Author URI: worpressdemo
*/

class worpressdemo {
    public function __construct() {
       

        add_shortcode('worpressdemo',  [$this,'worpressdemo_shortcode']);
       
    }



  
    /**
     * Shortcode: [worpressdemo]
     * @return string
     */
    function worpressdemo_shortcode() {
        echo 'worpressdemo test';
    }



}
new worpressdemo();
