<?php

/*
Plugin Name: worpressdemo
Plugin URI: worpressdemo
Description: worpressdemo Test
Author: 
Version: 1.7.2
Author URI: worpressdemo
*/

class worpressdemo
{
    public function __construct()
    {
        add_shortcode('worpressdemo',  [$this, 'worpressdemo_shortcode']);
        add_shortcode('worpressdemo_header_image',  [$this, 'headerImage']);
         add_shortcode('worpressdemo_menu_class',  [$this, 'menuClass']);
    }




    /**
     * Shortcode: [worpressdemo]
     * @return string
     */
    function worpressdemo_shortcode()
    {
        echo 'worpressdemo test';
    }

    function headerImage()
    {
        global $post;
        $url = match ($post->post_name) {
            'mollie-payments' => '/wp-content/plugins/worpressdemo/images/headerImages/2.webp',
            'festival-program' => '/wp-content/plugins/worpressdemo/images/headerImages/3.webp',
            'world-map' => '/wp-content/plugins/worpressdemo/images/headerImages/4.webp',
            default => '/wp-content/plugins/worpressdemo/images/headerImages/1.webp'
        };
        echo $url;
    }

     function menuClass()
    {
        global $post;
        $class = match ($post->post_name) {
            'festival-program' =>  'wp-demo_menu_white',
            default =>  'wp-demo_menu_blue'
        };
        
        echo $class;
    }
}
new worpressdemo();
