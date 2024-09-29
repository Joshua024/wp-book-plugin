<?php

class Book_Post_Type {

    public function __construct() {
        add_action( 'init', array( $this, 'register_book_post_type' ) );
    }

    public function register_book_post_type() {
        $labels = array(
            'name'               => _x( 'Books', 'Post type general name', 'book-plugin' ),
            'singular_name'      => _x( 'Book', 'Post type singular name', 'book-plugin' ),
            'menu_name'          => _x( 'Books', 'Admin Menu text', 'book-plugin' ),
            'name_admin_bar'     => _x( 'Book', 'Add New on Toolbar', 'book-plugin' ),
            'add_new'            => __( 'Add New', 'book-plugin' ),
            'add_new_item'       => __( 'Add New Book', 'book-plugin' ),
            'new_item'           => __( 'New Book', 'book-plugin' ),
            'edit_item'          => __( 'Edit Book', 'book-plugin' ),
            'view_item'          => __( 'View Book', 'book-plugin' ),
            'all_items'          => __( 'All Books', 'book-plugin' ),
            'search_items'       => __( 'Search Books', 'book-plugin' ),
            'parent_item_colon'  => __( 'Parent Books:', 'book-plugin' ),
            'not_found'          => __( 'No books found.', 'book-plugin' ),
            'not_found_in_trash' => __( 'No books found in Trash.', 'book-plugin' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 21, 
            'menu_icon'          => 'dashicons-book-alt',
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'        => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
        );

        register_post_type( 'book', $args );
    }
}
