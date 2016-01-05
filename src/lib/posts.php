<?php

/**
 * Creates a coach post type
 */
function wp_wodify_posts_register_post_type_coach ( ) {
  register_post_type( 'wp_wodify_coach',
    array(
      '_builtin'    => false,
      'public'      => true,
      'has_archive' => true,
      'rewrite'     => array(
        'slug'       => 'coaches',
        // 'with_front' => false,
      ),
      'labels'      => array(
        'name'          => __( 'Coaches' ),
        'singular_name' => __( 'Coach' )
      ),
      'supports'    => array(
        'title',
        'thumbnail',
        'revisions',
        'excerpt',
      ),
    )
  );
}


/**
 * Creates a location post type
 */
function wp_wodify_posts_register_post_type_location ( ) {
  register_post_type( 'wp_wodify_location',
    array(
      '_builtin'    => false,
      'public'      => true,
      'has_archive' => true,
      'rewrite'     => array(
        'slug'       => 'locations',
        // 'with_front' => false,
      ),
      'labels'      => array(
        'name'          => __( 'Locations' ),
        'singular_name' => __( 'Location' )
      ),
      'supports'    => array(
        'title',
        'thumbnail',
        'revisions',
        'excerpt',
      ),
    )
  );
}

/**
 * sets up all of the taxonomies for this plugin
 */
function wp_wodify_posts_register_taxonomy ( ) {
  $post_types = array( 'wp_wodify_location', 'wp_wodify_coach', 'post' );

  register_taxonomy( 'wp_wodify_programs', $post_types,  array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name'              => _x( 'Programs', 'taxonomy general name' ),
      'singular_name'     => _x( 'Program', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Programs' ),
      'all_items'         => __( 'All Programs' ),
      'edit_item'         => __( 'Edit Program' ),
      'update_item'       => __( 'Update Program' ),
      'add_new_item'      => __( 'Add New Program' ),
      'new_item_name'     => __( 'New Program' ),
      'menu_name'         => __( 'Programs' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug'         => 'programs',
      'with_front'   => false,
      'hierarchical' => false,
    ),
  ));

}
