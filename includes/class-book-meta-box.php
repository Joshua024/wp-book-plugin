<?php

class Book_Meta_Box {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_book_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_book_meta' ) );
    }

    public function add_book_meta_box() {
        add_meta_box(
            'book_details',
            __( 'Book Details', 'book-plugin' ),
            array( $this, 'render_meta_box' ),
            'book',
            'normal',
            'high'
        );
    }

    public function render_meta_box( $post ) {
        wp_nonce_field( 'book_details_meta_box', 'book_details_nonce' );
        $author_name = get_post_meta( $post->ID, '_book_author_name', true );
        echo '<label for="book_author_name">' . __( 'Author Name', 'book-plugin' ) . '</label>';
        echo '<input type="text" id="book_author_name" name="book_author_name" value="' . esc_attr( $author_name ) . '" size="25" />';
    }

    public function save_book_meta( $post_id ) {
        if ( ! isset( $_POST['book_details_nonce'] ) || ! wp_verify_nonce( $_POST['book_details_nonce'], 'book_details_meta_box' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( 'book' == $_POST['post_type'] && current_user_can( 'edit_post', $post_id ) ) {
            $author_name = sanitize_text_field( $_POST['book_author_name'] );
            update_post_meta( $post_id, '_book_author_name', $author_name );
        }
    }
}
