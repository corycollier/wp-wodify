<?php

/**
 * function add the wodify menu to the admin menus
 */
function wp_wodify_admin_menu() {
  add_options_page(
    'WP Wodify Options',
    'WP Wodify',
    'manage_options',
    'wp-wodify-administer',
    'wp_wodify_admin_options'
  );
}

/**
 * Function to display the wp-wodify admin options
 */
function wp_wodify_admin_options() {

  if ( !current_user_can( 'manage_options' ) ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

  wp_wodify_admin_init();

  echo '<div class="wrap">
    <h2>WP Wodify Settings</h2>
    <p>Change and update settings for Wodify integration here</p>
    <form action="options.php" method="POST">
  ';

  settings_fields( 'wp-wodify-settings-group' );
  do_settings_sections( 'wp-wodify-administer' );

  echo get_submit_button();
  echo '</form>
    </div>
  ';

  echo '<div class="wrap">
    <h2>API Synchronize</h2>
    <p>Use the buttons below to synchronize various parts of the Wodify API</p>
  ';

  echo _wp_wodify_api_sync_form( 'classes' );
  echo _wp_wodify_api_sync_form( 'coaches' );
  echo _wp_wodify_api_sync_form( 'locations' );
  echo _wp_wodify_api_sync_form( 'programs' );
  echo '</div>';


  echo '<div class="wrap">
    <h2>Post Type Creation</h2>
    <p>Create Wordpress post types, to match what comes from Wodify</p>
  ';

  echo _wp_wodify_api_sync_form( 'create_post_type_coach' );
  echo '</div>';

  echo _wp_wodify_admin_display_api_cache( 'coach', 'coaches' );
  echo _wp_wodify_admin_display_api_cache( 'location', 'locations' );
  echo _wp_wodify_admin_display_api_cache( 'program', 'programs' );
  echo _wp_wodify_admin_display_api_cache( 'class', 'classes' );

  echo '</div>';

}

/**
 * function to display api cache values
 *
 * @param string $name the name of the option
 * @param string $plural the pluralized version of the name
 */
function _wp_wodify_admin_display_api_cache ( $name, $plural ) {

  $proper_plural = ucfirst( $plural );
  $proper_single = ucfirst( $name );
  $func          = '_wp_wodify_admin_template_api_cache_' . $name;
  $option        = get_option( '_wp_wodify_api_cache_' . $plural );
  $values        = json_decode( $option )->RecordList->{$proper_single};
  $template      = '<div class="wrap"><h2>!title</h2>!cache</div>';
  $cache         = '';

  foreach ($values as $value) {
    $cache .= call_user_func( $func, $value );
  }

  return strtr($template, array(
    '!title' => $proper_plural,
    '!cache' => $cache,
  ));
}


/**
 * registers the settings that are unique to the plugin
 */
function wp_wodify_admin_register_settings ( ) {
  register_setting( 'wp-wodify-settings-group', 'wp-wodify-api-key' );
  register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_classes' );
  register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_coaches' );
  register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_locations' );
  register_setting( 'wp-wodify-settings-cache', '_wp_wodify_api_cache_programs' );
}


/**
 * Function to register the settings with the settings api
 */
function wp_wodify_admin_init ( ) {
  wp_wodify_admin_register_settings();
  add_settings_section( 'section-one'
    , 'Section One'
    , 'wp_wodify_admin_section_callback'
    , 'wp-wodify-administer'
  );

  add_settings_field( 'wp-wodify-api-key'
    , 'Api Key'
    , 'wp_wodify_admin_api_key_field_callback'
    , 'wp-wodify-administer'
    , 'section-one'
  );

  $types = array('coaches', 'classes', 'locations', 'programs');
  foreach ($types as $type) {
    add_action( 'admin_post_wp_wodify_' . $type . '_sync',   'wp_wodify_get_api_' . $type );
  }

  add_action( 'admin_enqueue_scripts', 'wp_wodify_admin_scripts' );
}

/**
 * function to output intro text for the first admin section
 */
function wp_wodify_admin_section_callback ( ) {
  echo '<p>Basic information goes here</p>';
}


*
 * function to output the api key input element on the admin page

function wp_wodify_admin_api_key_field_callback ( ) {
  $setting = get_option( 'wp-wodify-api-key' );
  echo '<input type="text" name="wp-wodify-api-key" value="' . esc_attr( $setting ) . '" />';
}

/**
 * function to handle api requests
 * @param  string $api_name the short name of the api to request (i.e. 'locations')
 * @param  array  $params   Associative array of parameters to include for the api
 * @return Object the resulting json object
 */
function wp_wodify_api_request ( $api_name, $params = array() ) {
  $api_key = get_option( 'wp-wodify-api-key' );
  $uri     = _wp_wodify_get_api_uri( $api_name );
  $data    = array_merge($params, array(
    'apikey'   => esc_attr( $api_key ),
    'type'     => 'json',
    'encoding' => 'utf-8',
  ));

  $result = wp_remote_get( sprintf('%s?%s', $uri, http_build_query($data) ) );
  return $result;
}

/**
 * Retrieves the uri for a requested api
 * @param  string $name Short name for the api (i.e. 'programs')
 * @return string       The uri (i.e. http://app.wodify.com/API/Programs_v1.aspx)
 */
function _wp_wodify_get_api_uri ($name = 'programs') {
  $map = array(
    'classes'      => 'http://app.wodify.com/API/Classes_v1.aspx',
    'coaches'      => 'http://app.wodify.com/API/Coaches_v1.aspx',
    'leaderboards' => 'http://app.wodify.com/API/Leaderboard_v1.aspx',
    'results'      => 'http://app.wodify.com/API/LeaderboardResults_v1.aspx',
    'locations'    => 'http://app.wodify.com/API/Locations_v1.aspx',
    'programs'     => 'http://app.wodify.com/API/Programs_v1.aspx',
    'whitebaord'   => 'http://app.wodify.com/API/Whiteboard_v1.aspx',
  );

  return $map[ $name ];
}

/**
 * Gets data from the api.
 * @param  string $name the name of the data to retrieve
 * @return boolean true if successful, false if not
 */
function wp_wodify_get_api_data ( $name ) {
  $result = wp_wodify_api_request( $name );
  $option = '_wp_wodify_api_cache_' . $name;
  update_option( $option , $result , false );
  return true;
}

/**
 * Gets the coaches from the Wodify API
 */
function wp_wodify_get_api_coaches ( ) {
  return wp_wodify_get_api_data( 'coaches' );
}

/**
 * Gets the classes from the Wodify API
 */
function wp_wodify_get_api_classes ( ) {
  return wp_wodify_get_api_data( 'classes' );
}

/**
 * Gets the locations from the Wodify API
 */
function wp_wodify_get_api_locations ( ) {
  return wp_wodify_get_api_data( 'locations' );
}

/**
 * Gets the programs from the Wodify API
 */
function wp_wodify_get_api_programs ( ) {
  return wp_wodify_get_api_data( 'programs' );
}

/**
 * creates a form to synchronize api settings from the wodify api
 * @param  string $name the name of the api to sync with
 * @return [type]       [description]
 */
function _wp_wodify_api_sync_form ( $name ) {

  $action = admin_url( 'admin-post.php' );
  $template = '<form action="!action">
    <input type="hidden" name="action" value="wp_wodify_!name_sync">
    !submit
    </form>';

  return strtr($template, array(
    '!action' => esc_attr( $action ),
    '!name'   => esc_attr( $name ),
    '!submit' => get_submit_button( 'Synchronize ' . $name ),
  ));
}

/**
 * Function to enqueue the admin javascript.
 *
 * @return bool true.
 */
function wp_wodify_admin_scripts() {
  $plugin_url = plugin_dir_url( __FILE__ ) . '../';
  wp_enqueue_script( 'wp_wodify_admin', $plugin_url . '/js/admin.js' );
  return true;
}

// add_action( 'admin_post_wp_wodify_classes_sync',   'wp_wodify_get_api_classes' );
// add_action( 'admin_post_wp_wodify_locations_sync', 'wp_wodify_get_api_locations' );
// add_action( 'admin_post_wp_wodify_programs_sync',  'wp_wodify_get_api_programs' );
// add_action( 'admin_post_wp_wodify_create_post_type_coach_sync',  'wp_wodify_admin_create_post_type_coach' );



function wp_wodify_admin_create_post_type_coach ( ) {
  wp_wodify_posts_register_post_type_coach();
}






