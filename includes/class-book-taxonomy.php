<?php

class Book_Taxonomy {

    public function __construct() {
        add_action( 'init', array( $this, 'register_genre_taxonomy' ) );
    }

    public function register_genre_taxonomy() {
        $labels = array(
            'name'              => _x( 'Genres', 'taxonomy general name', 'book-plugin' ),
            'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'book-plugin' ),
            'search_items'      => __( 'Search Genres', 'book-plugin' ),
            'all_items'         => __( 'All Genres', 'book-plugin' ),
            'parent_item'       => __( 'Parent Genre', 'book-plugin' ),
            'parent_item_colon' => __( 'Parent Genre:', 'book-plugin' ),
            'edit_item'         => __( 'Edit Genre', 'book-plugin' ),
            'update_item'       => __( 'Update Genre', 'book-plugin' ),
            'add_new_item'      => __( 'Add New Genre', 'book-plugin' ),
            'new_item_name'     => __( 'New Genre Name', 'book-plugin' ),
            'menu_name'         => __( 'Genre', 'book-plugin' ),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'genre' ),
        );

        register_taxonomy( 'genre', array( 'book' ), $args );
    }
}
