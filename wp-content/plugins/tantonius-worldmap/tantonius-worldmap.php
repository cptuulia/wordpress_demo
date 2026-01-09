<?php

/*
Plugin Name: Tantonius World Map
Plugin URI: https://tantonius.com/
Description: Customized plugin for the foundation Hand en Poot
Author: T. Antonius
Version: 1.0
Author URI: https://tantonius.com/
*/


class TantoniusWorldMap
{
    public function __construct()
    {
         add_action('admin_menu', [$this, 'adminMenu']);

        /** [tantonius-worldmap] */
        add_shortcode('tantonius-worldmap',  [$this, 'worldmap']);
       
    }

    function adminMenu()
    {
        // Note: 'edit_pages' gives rights for an editor for this function
        // 'manage_options' only for admin.
        // see more in 
        // https://wordpress.org/support/topic/how-to-allow-non-admins-editors-authors-to-use-certain-wordpress-plugins/


        add_menu_page(
            'Worldmap menu',
            'World Map',
            'edit_pages',
            'tantonius-worldmap/tantonius-worldmap',
            [$this, 'tantonius-worldmapAdminMainPage'],
            'dashicons-pets',
            6
        );




    }
    
    /**
     * World map
     * 
     * @return string
     */
    function worldmap()
    { 
        ob_start(); 
        include 'front/map/map.php';
        $content = ob_get_clean();
        return $content;
    }

  
    
      /** 
     * This function is called when the plugin is activated
     *  
     **/
    public static function pluginActivation() {
		// Do your code here
	}

        /** 
     * This function is called when the plugin is de activated
     *  
     **/
      public static function pluginDeactivation() {
		// Do your code here
	}

   

}
new TantoniusWorldMap();

// Registrate functions for plugin activation and deactivation
register_activation_hook( __FILE__, array( 'TantoniusWorldMap', 'pluginActivation' ) );
register_deactivation_hook( __FILE__, array( 'TantoniusWorldMap', 'pluginDeactivation' ) );


wp_register_script('tantonius_world_map_js1', plugins_url('plugins/js/svg-zoom-pan.js', __FILE__), array('jquery'));
wp_enqueue_script('tantonius_world_map_js1');

