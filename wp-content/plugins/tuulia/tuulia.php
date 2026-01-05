<?php

/*
Plugin Name: tuulia
Plugin URI: tuulia
Description: Tuulia Test
Author: tuulia
Version: 1.7.2
Author URI: tuulia
*/

class tuulia {
    public function __construct() {
        add_action( 'admin_menu', [$this,'my_admin_menu'] );

        add_shortcode('tuulia',  [$this,'tuulia_shortcode']);
        add_shortcode('tuulia2',  [$this,'tuulia_shortcode2']);
        add_shortcode('tuulia_current_user',  [$this,'tuulia_currentUser']);
    }


    function my_admin_menu() {
        add_menu_page( 'Tuulia Menu Example',
            'Tuulia',
            'manage_options',
            'tuulia/tuulia',
            [$this, 'tuulia_admin_page'],
            'dashicons-tickets', 6  );
        add_submenu_page( 'tuulia/tuulia',
            'Tuulia sub',
            'Tuulia sub',
            'manage_options',
            'tuulia/tuulia2',
            [$this, 'tuulia_admin_sub_page']  );
    }

    function tuulia_admin_page()
    {
       echo 'tuulia admin page';
    }
    function tuulia_admin_sub_page()
    {
        echo 'tuulia_admin_sub_page';
    }
    /**
     * Shortcode: [tuulia]
     * @return string
     */
    function tuulia_shortcode() {
        return 'tuulia test';
    }


    /**
     * Shortcode: [tuulia]
     * @return string
     */
    function tuulia_currentUser() {

        $FEUP = new FEUP_User;
        if ($FEUP->Get_Username()) {
            return 'Currently logged user:  ' .$FEUP->Get_Username();
        }
        return 'No current user';

    }

    /**
     * Shortcode: [tuulia2 title="WordPress.org"]
     *
     * @param $param
     * @return string
     */
    function tuulia_shortcode2($param) {
        return 'tuulia test2, You sent params :  ' . json_encode($param);
    }

}
new tuulia();
function year_shortcode() {
    $year = date('Y');
    return $year;
}
add_shortcode('datetoday', 'year_shortcode');