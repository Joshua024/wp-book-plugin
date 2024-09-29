<?php
/**
 * Plugin Name: Book Plugin
 * Description: A plugin to create a custom post type for books.
 * Version: 1.2
 * Author: Joshua C. Adumchimma
 * Author URI: https://dev-joshua-web-developer.pantheonsite.io/
 * Support Email: adumchimajoshua@gmail.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


define( 'BOOK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );


require_once BOOK_PLUGIN_PATH . 'includes/class-book-post-type.php';
require_once BOOK_PLUGIN_PATH . 'includes/class-book-meta-box.php';
require_once BOOK_PLUGIN_PATH . 'includes/class-book-taxonomy.php';
require_once BOOK_PLUGIN_PATH . 'includes/class-book-template.php';


function book_plugin_init() {
    new Book_Post_Type();
    new Book_Meta_Box();
    new Book_Taxonomy();
    new Book_Template();
}
add_action( 'plugins_loaded', 'book_plugin_init' );


register_activation_hook( __FILE__, 'book_plugin_activate' );
function book_plugin_activate() {
   
    book_plugin_init();
    flush_rewrite_rules();
}


function my_plugin_enqueue_styles() {
    wp_enqueue_style( 'my-plugin-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue_styles' );



register_deactivation_hook( __FILE__, 'book_plugin_deactivate' );
function book_plugin_deactivate() {
    flush_rewrite_rules();
}
