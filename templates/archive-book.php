<?php
get_header();
?>

<form method="get">
    <label for="genre">Filter by Genre:</label>
    <select name="genre" id="genre">
        <option value="">All Genres</option>
        <?php 
        $genres = get_terms( array(
            'taxonomy' => 'genre',
            'hide_empty' => false,
        ));

        foreach ( $genres as $genre ) {
            echo '<option value="' . esc_attr( $genre->slug ) . '" ' . selected( isset( $_GET['genre'] ) && $_GET['genre'] == $genre->slug, true, false ) . '>' . esc_html( $genre->name ) . '</option>';
        }
        ?>
    </select>
    <button type="submit">Filter</button>
</form>


<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header>

        <div class="book-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                    </header>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

    <?php else : ?>

        <p><?php _e( 'No books found.', 'book-plugin' ); ?></p>

    <?php endif; ?>

    </main>
</div>

<?php
get_footer();
