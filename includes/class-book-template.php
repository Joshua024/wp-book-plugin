<?php

class Book_Template {

    public function __construct() {
        add_filter( 'template_include', array( $this, 'load_archive_template' ) );
        add_action( 'the_content', array( $this, 'display_author_name' ) );
    }

    public function load_archive_template( $template ) {
        if ( is_post_type_archive( 'book' ) ) {
            $template = BOOK_PLUGIN_PATH . 'templates/archive-book.php';
        }
        return $template;
    }

    public function display_author_name( $content ) {
        if ( is_singular( 'book' ) ) {
            $author_name = get_post_meta( get_the_ID(), '_book_author_name', true );
            if ( $author_name ) {
                $content .= '<p><strong>Author:</strong> ' . esc_html( $author_name ) . '</p>';
            }
        }
        return $content;
    }

    public function filter_books_by_genre( $query ) {
        if ( is_post_type_archive( 'book' ) && $query->is_main_query() && !is_admin() ) {
            if ( isset( $_GET['genre'] ) && !empty( $_GET['genre'] ) ) {
                $genre = sanitize_text_field( $_GET['genre'] );
                $query->set( 'tax_query', array(
                    array(
                        'taxonomy' => 'genre',
                        'field'    => 'slug',
                        'terms'    => $genre,
                    ),
                ));
            }
        }
    }
    
}
