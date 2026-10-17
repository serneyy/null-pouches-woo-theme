<?php
if (!defined('ABSPATH')) { exit; }
add_action('after_setup_theme', function() {
 add_theme_support('title-tag');
 add_theme_support('post-thumbnails');
 add_theme_support('woocommerce');
 add_theme_support('wc-product-gallery-zoom');
 add_theme_support('wc-product-gallery-lightbox');
 add_theme_support('wc-product-gallery-slider');
 add_theme_support('custom-logo');
 register_nav_menus(array('primary' => 'Primary'));
});
function null_landing_language() {
 $lang = get_query_var('null_lang', 'en');
 return in_array($lang, array('sk', 'cs', 'de', 'pl', 'ro'), true) ? $lang : 'en';
}
function null_is_landing() {
 return is_front_page() || (bool) get_query_var('null_lang');
}
function null_shop_url() {
 return function_exists('wc_get_page_permalink') ? (wc_get_page_permalink('shop') ?: home_url('/shop/')) : home_url('/shop/');
}
function null_cart_url() {
 return function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
}
function null_count() {
 return function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
}
function null_pouches_product_url($slug) {
 if (post_type_exists('product')) {
  $post = get_page_by_path(sanitize_title($slug), OBJECT, 'product');
  if ($post && $post->post_status === 'publish') return get_permalink($post->ID);
 }
 return null_shop_url();
}
add_filter('woocommerce_add_to_cart_fragments', function($fragments) {
 $fragments['span.null-count'] = '<span class="null-count">' . esc_html(null_count()) . '</span>';
 return $fragments;
});
add_action('wp_enqueue_scripts', function() {
 // The landing carries the original CSS, Tailwind, scripts and fonts inline.
 // Enqueuing store styles here would change the original 1:1 design.
 if (null_is_landing()) return;
 wp_enqueue_style('null-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Unbounded:wght@600;700;800;900&display=swap', array(), null);
 wp_enqueue_style('null-base', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
 wp_enqueue_style('null-store', get_template_directory_uri() . '/assets/store.css', array('null-base'), wp_get_theme()->get('Version'));
});
add_filter('query_vars', function($vars) { $vars[] = 'null_lang'; return $vars; });
function null_landing_rewrites() {
 foreach (array('sk','cs','de','pl','ro') as $lang) {
  add_rewrite_rule('^' . $lang . '/?$', 'index.php?null_lang=' . $lang, 'top');
 }
}
add_action('init', 'null_landing_rewrites');
add_action('after_switch_theme', function() { null_landing_rewrites(); flush_rewrite_rules(); });
add_filter('pre_handle_404', function($handled, $query) {
 if (get_query_var('null_lang')) { $query->is_404 = false; return true; }
 return $handled;
}, 10, 2);
add_filter('template_include', function($template) {
 if (get_query_var('null_lang')) return get_theme_file_path('front-page.php');
 return $template;
}, 99);
add_filter('redirect_canonical', function($redirect) {
 return get_query_var('null_lang') ? false : $redirect;
});
