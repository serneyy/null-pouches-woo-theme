<?php
if (!defined('ABSPATH')) exit;
add_action('after_setup_theme',function(){
 add_theme_support('title-tag'); add_theme_support('post-thumbnails');
 add_theme_support('woocommerce');
 add_theme_support('wc-product-gallery-lightbox');
 add_theme_support('wc-product-gallery-slider');
 register_nav_menus(['primary'=>'Primary']);
});
add_action('wp_enqueue_scripts',function(){
 wp_enqueue_style('null-font','https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Unbounded:wght@600;700;800;900&display=swap',[],null);
 wp_enqueue_style('null-base',get_stylesheet_uri(),[],wp_get_theme()->get('Version'));
 wp_enqueue_style('null-store',get_template_directory_uri().'/assets/store.css',['null-base'],wp_get_theme()->get('Version'));
});
function null_shop_url(){return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop'):home_url('/shop/');}
function null_cart_url(){return function_exists('wc_get_cart_url') ? wc_get_cart_url():home_url('/cart/');}
function null_count(){return function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count():0;}
add_filter('woocommerce_add_to_cart_fragments',function($fragments){$fragments['span.null-count']='<span class="null-count">'.esc_html(null_count()).'</span>';return $fragments;});
