<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);


if ($_SERVER["HTTP_HOST"] == "test.hand_en_poot.nl") {
    if (isset($_GET['gatesttoken'])) {
        if ($_GET['gatesttoken'] = 'seufhyeiuryr44ygafdsg34HHGY') {
            setcookie('gatesttoken', $_GET['gatesttoken']);
        }
    }
    if (!isset($_COOKIE['gatesttoken']) && !isset($_GET['env'])) {
        die('acces deni1ed');
    }

}

////////////////////////////////////////////////////
// Additions for the API
require_once(__DIR__ . '/api_/Kamergro/Lib/php8.php');

if (str_starts_with($_SERVER ['REQUEST_URI'], '/api')) {
    require_once 'api_/public/index.php';
    die;
}
////////////////////////////////////////////////////
/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
