<?php 
/**
* 
*
* @package     AU Books
* @author      Akhilesh
* @license     GPL-2.0-or-later
*
* @wordpress-plugin
* Plugin Name: AU Books
* Plugin URI:  https://github.com/maxeclairs/au-books
* Description: Plugin to add and display books and related information using Custom Post Types
* Version:     1.0.0
* Author:      Akhilesh
* Author URI:  https://github.com/maxeclairs
* Text Domain: au-books
* License:     GPL v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function create_books_cpt() {
    $labels = array(
        'name' => __( 'Books', 'au-books' ),
        'singular_name' => __( 'Book', 'au-books' ),
        'menu_name' => __( 'Books', 'au-books' ),
        'name_admin_bar'=> __( 'Book', 'au-books' ),
        'archives' => __( 'Book Archives', 'au-books' ),
        'attributes' => __( 'Book Attributes', 'au-books' ),
        'parent_item_colon' => __( 'Parent Book:', 'au-books' ),
        'all_items' => __( 'All Books', 'au-books' ),
        'add_new' => __( 'Add New', 'au-books' ),
        'add_new_item' => __( 'Add New Book', 'au-books' ),
        'new_item' => __( 'New Book', 'au-books' ),
        'edit_item' => __( 'Edit Book', 'au-books' ),
        'update_item' => __( 'Update Book', 'au-books' ),
        'view_item' => __( 'View Book', 'au-books' ),
        'view_items' => __( 'View Books', 'au-books' ),
        'search_items' => __( 'Search Books', 'au-books' ),
        'not_found' => __( 'Not found', 'au-books' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'au-books' ),
        'featured_image' => __( 'Featured Image', 'au-books' ),
        'set_featured_image' => __( 'Set featured image', 'au-books' ),
        'remove_featured_image' => __( 'Remove featured image', 'au-books' ),
        'use_featured_image' => __( 'Use as featured image', 'au-books' ),
        'insert_into_item' => __( 'Insert into book', 'au-books' ),
        'uploaded_to_this_item' => __( 'Uploaded to this book', 'au-books' ),
        'items_list' => __( 'Books list', 'au-books' ),
        'items_list_navigation' => __( 'Books list navigation', 'au-books' ),
        'filter_items_list' => __( 'Filter books list', 'au-books' ),
    );
    $args = array(
        'label' => __( 'Book', 'au-books' ),
        'description' => __( 'Books', 'au-books' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-book',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'rewrite' => array( 'slug' => 'books', 'with_front' => false ),
        'taxonomies' => array( 'category', 'post_tag' ),
    );
    register_post_type( 'books', $args );

}
add_action( 'init', 'create_books_cpt', 0 );


// Register Custom Taxonomy

function create_book_taxonomies() {
    $labels = array(
        'name' => __( 'Book Categories', 'au-books' ),
        'singular_name' => __( 'Book Category', 'au-books' ),
        'menu_name' => __( 'Book Categories', 'au-books' ),
        'search_items' => __( 'Search Book Categories', 'au-books' ),
        'all_items' => __( 'All Book Categories', 'au-books' ),
        'edit_item' => __( 'Edit Book Category', 'au-books' ),
        'view_item' => __( 'View Book Category', 'au-books' ),
        'update_item' => __( 'Update Book Category', 'au-books' ),
        'add_new_item' => __( 'Add New Book Category', 'au-books' ),
        'new_item_name' => __( 'New Book Category Name', 'au-books' ),
        'parent_item' => __( 'Parent Book Category', 'au-books' ),
        'parent_item_colon' => __( 'Parent Book Category:', 'au-books' ),
        'search_items' => __( 'Search Book Categories', 'au-books' ),
        'popular_items' => __( 'Popular Book Categories', 'au-books' ),
        'separate_items_with_commas' => __( 'Separate Book Categories with commas', 'au-books' ),
        'add_or_remove_items' => __( 'Add or remove Book Categories', 'au-books' ),
        'choose_from_most_used' => __( 'Choose from the most used Book Categories', 'au-books' ),
        'not_found' => __( 'No Book Categories found', 'au-books' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'book-categories', 'with_front' => false ),
        'update_count_callback' => '_update_post_term_count',
    );
    register_taxonomy( 'book_category', array( 'books' ), $args );
}
add_action( 'init', 'create_book_taxonomies', 0 );

function create_book_tag_taxonomies() {
    $labels = array(
        'name' => __( 'Book Tag', 'au-books' ),
        'singular_name' => __( 'Book Tag', 'au-books' ),
        'menu_name' => __( 'Book Tags', 'au-books' ),
        'search_items' => __( 'Search Book Tags', 'au-books' ),
        'all_items' => __( 'All Book Tags', 'au-books' ),
        'edit_item' => __( 'Edit Book Tag', 'au-books' ),
        'view_item' => __( 'View Book Tag', 'au-books' ),
        'update_item' => __( 'Update Book Tag', 'au-books' ),
        'add_new_item' => __( 'Add New Book Tag', 'au-books' ),
        'new_item_name' => __( 'New Book Tag Name', 'au-books' ),
        'search_items' => __( 'Search Book Tags', 'au-books' ),
        'popular_items' => __( 'Popular Book Tags', 'au-books' ),
        'separate_items_with_commas' => __( 'Separate Book Tags with commas', 'au-books' ),
        'add_or_remove_items' => __( 'Add or remove Book Tags', 'au-books' ),
        'choose_from_most_used' => __( 'Choose from the most used Book Tags', 'au-books' ),
        'not_found' => __( 'No Book Tags found', 'au-books' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'book-tags', 'with_front' => false ),
        'update_count_callback' => '_update_post_term_count',
    );
    register_taxonomy( 'book_tag', array( 'books' ), $args );
}
add_action( 'init', 'create_book_tag_taxonomies', 0 );


function rewrite_book_flush() {
    create_books_cpt();
    create_book_taxonomies();
    flush_rewrite_rules();    
}

register_activation_hook( __FILE__, 'rewrite_book_flush' );

// add custom meta box to custom post type
function au_add_book_meta_boxes() {
    add_meta_box(
        'book_meta_box', //div id containing all the meta box content
        __( 'Book Details', 'au-books' ), //title of the meta box
        'display_book_meta_box', //callback function to display the meta box content
        'books', //post type to display the meta box
        'normal', //where to display the meta box
        'high' //priority of the meta box
    );
}
add_action( 'add_meta_boxes', 'au_add_book_meta_boxes' );


function display_book_meta_box() {
    global $post;
    $book_author = get_post_meta( $post->ID, 'book_author', true );
    $book_publisher = get_post_meta( $post->ID, 'book_publisher', true );
    $book_price = get_post_meta( $post->ID, 'book_price', true );
    $book_year = get_post_meta( $post->ID, 'book_year', true );
    $bok_edition = get_post_meta( $post->ID, 'book_edition', true );
    $book_url = get_post_meta( $post->ID, 'book_url', true );

    wp_nonce_field( 'save_book_meta_box_data', 'book_meta_box_nonce' );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="book_author"><?php _e( 'Author', 'au-books' ); ?></label></th>
            <td><input type="text" name="book_author" id="book_author" value="<?php echo esc_attr( $book_author ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="book_publisher"><?php _e( 'Publisher', 'au-books' ); ?></label></th>
            <td><input type="text" name="book_publisher" id="book_publisher" value="<?php echo esc_attr( $book_publisher ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="book_price"><?php _e( 'Price', 'au-books' ); ?></label></th>
            <td><input type="text" name="book_price" id="book_price" value="<?php echo esc_attr( $book_price ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="book_year"><?php _e( 'Year', 'au-books' ); ?></label></th>
            <td><input type="text" name="book_year" id="book_year" value="<?php echo esc_attr( $book_year ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="book_edition"><?php _e( 'Edition', 'au-books' ); ?></label></th>
            <td><input type="text" name="book_edition" id="book_edition" value="<?php echo esc_attr( $bok_edition ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="book_url"><?php _e( 'URL', 'au-books' ); ?></label></th>
            <td><input type="text" name="book_url" id="book_url" value="<?php echo esc_attr( $book_url ); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
    
}

// save custom meta box field values
function save_book_meta_box( $post_id ) {
    // check if nonce is set
    if ( ! isset( $_POST[ 'book_meta_box_nonce' ] ) ) {
        return;
    }
    // check if nonce is valid
    if ( ! wp_verify_nonce( $_POST[ 'book_meta_box_nonce' ], 'save_book_meta_box_data' ) ) {
        return;
    }
    
    // check if user has permissions to save data
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    // check if not an autosave
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }
    // check if not a revision
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }
    // save the data
    if ( isset( $_POST[ 'book_author' ] ) ) {
        update_post_meta( $post_id, 'book_author', sanitize_text_field( $_POST[ 'book_author' ] ) );
    }
    if ( isset( $_POST[ 'book_price' ] ) ) {
        update_post_meta( $post_id, 'book_price', sanitize_text_field( $_POST[ 'book_price' ] ) );
    }
    if ( isset( $_POST[ 'book_publisher' ] ) ) {
        update_post_meta( $post_id, 'book_publisher', sanitize_text_field( $_POST[ 'book_publisher' ] ) );
    }
    if ( isset( $_POST[ 'book_year' ] ) ) {
        update_post_meta( $post_id, 'book_year', sanitize_text_field( $_POST[ 'book_year' ] ) );
    }
    if ( isset( $_POST[ 'book_edition' ] ) ) {
        update_post_meta( $post_id, 'book_edition', sanitize_text_field( $_POST[ 'book_edition' ] ) );
    }
    if ( isset( $_POST['book_url'] ) ) {
        update_post_meta( $post_id, 'book_url', sanitize_text_field( $_POST[ 'book_url' ] ) );
    }
}
add_action( 'save_post', 'save_book_meta_box' );

