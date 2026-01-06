<?php

/*
Plugin Name: tantonius-mollie
Plugin URI: mollie
Description: Mollie plugin
Author: T.Antonius
Version: 1.7.2
Author URI: tantonius.com
*/


require_once 'lib/TaMollieAdminSettings.php';

class TaMollie {
    public function __construct() {       
        add_shortcode('ta_mollie_recurring_payment_form',  [$this,'recurringPaymentForm']);
        add_action('admin_menu', array('TaMollieAdminSettings','addSettingsPage'));
        add_action('admin_menu', [$this, 'adminMenu']);

    }


    /**
     * adminSlideshowMenu
     */
    function adminMenu()
    {
        // 'edit_pages' gives rights for an editor for this function
        // 'manage_options' only for admin.
        // see more in 
        // https://wordpress.org/support/topic/how-to-allow-non-admins-editors-authors-to-use-certain-wordpress-plugins/

        add_menu_page(
            'Mollie Clients',
            'Mollie Clients',
            'edit_pages',
            'tantoniusmollie/clients',
            [$this, 'categories'],
            'dashicons-money',
            6
        );

    }

        /**
     *  Category_index
     */
    function categories()
    {
        return include('admin/clients.php');
    }


    /**
     * Shortcode: [mollie]
     * @return string
     */
    function recurringPaymentForm() {
        ob_start();
        include 'front/recurringPaymentForm.php';
        $content = ob_get_clean();
           
        return $content;
    }
}
new TaMollie();
