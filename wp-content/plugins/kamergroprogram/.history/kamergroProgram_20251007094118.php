<?php

/*
Plugin Name: Kamermuziekfestival Groningen Program
Plugin URI: wp-content/plugins/kamergro_program/info.html
Description: kamergroProgram Test
Author: kamergroProgram
Version: 1.0
Author URI: slideho w
*/
require_once __DIR__ . '/api_/vendor/autoload.php';
require_once __DIR__ . '/lib/ProgramTranslations.php';

class KamergroProgram {
          public function __construct()
    {
        add_action('admin_menu', [$this, 'adminProgramMenu']);
    }



    /**
     * adminProgramMenu
     */
    function adminProgramMenu()
    {
        // 'edit_pages' gives rights for an editor for this function
        // 'manage_options' only for admin.
        // see more in 
        // https://wordpress.org/support/topic/how-to-allow-non-admins-editors-authors-to-use-certain-wordpress-plugins/

        add_menu_page(
            'program menu',
            'Program',
            'edit_pages',
            'program/program',
            [$this, 'categories'],
            'dashicons-playlist-audio',
            6
        );

        add_submenu_page(
            'program/program',
            'Programs',
            'Programs',
            'edit_pages',
            'program/categories',
            [$this, 'categories']
        );

        add_submenu_page(
            '',
            'Edit Program',
            'Edit Program',
            'edit_pages',
            'program/editcategory',
            [$this, 'editCategory']
        );

        add_submenu_page(
            '',
            'Edit Catgegory Item',
            'Edit Catgegory Item',
            'edit_pages',
            'program/editcategoryitem',
            [$this, 'editCategoryItem']
        );

        add_submenu_page(
            '',
            'Edit Catgegory Item Media',
            'Edit Catgegory Item Media',
            'edit_pages',
            'program/editcategoryitemmedia',
            [$this, 'editEvent']
        );
    }

    /**
     *  Category_index
     */
    function categories()
    {   
        return include('admin/categories.php');
    }

    /**
     * Edit category
     */
    function editCategory()
    {
        return include('admin/editCategory.php');
    }

        /**
     *  Edit category item
     */
    function editCategoryItem()
    {
        return include('admin/editCategoryItem.php');
    }

     /**
     *  Edit event
     */
    function editEvent()
    {
        return include('admin/editEvent.php');
    }

}

new KamergroProgram();