<?php
/**
 * Original NULL landing HTML per language. The included files are complete
 * documents so they can retain their CSS, JS, font layout and animations.
 * Each template calls wp_head(), wp_body_open(), and wp_footer().
 */
if (!defined('ABSPATH')) { exit; }
$lang = function_exists('null_landing_language') ? null_landing_language() : 'en';
$path = get_theme_file_path('landing/' . $lang . '.php');
if (!file_exists($path)) { $path = get_theme_file_path('landing/en.php'); }
include $path;
