<?php

/**
 * function add the wodify menu to the admin menus
 */
function wp_wodify_admin_menu ( ) {
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
function wp_wodify_admin_options ( ) {

  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

  echo '<div class="wrap">'
    , '<h2>WP Wodify Settings</h2>'
    , '<p>Change and update settings for Wodify integration here</p>'
    , '<form action="options.php" method="POST">'
  ;

  settings_fields( 'wp-wodify-settings-group' );
  do_settings_sections( 'wp-wodify-administer' );
  submit_button();

  echo '</form>'
    , '</div>'
  ;

}


/**
 * Function to register the settings with the settings api
 */
function wp_wodify_admin_init ( ) {

  register_setting( 'wp-wodify-settings-group', 'wp-wodify-api-key' );
  register_setting( 'wp-wodify-settings-cache', 'wp-wodify-api-cache-classes' );
  register_setting( 'wp-wodify-settings-cache', 'wp-wodify-api-cache-coaches' );
  register_setting( 'wp-wodify-settings-cache', 'wp-wodify-api-cache-locations' );
  register_setting( 'wp-wodify-settings-cache', 'wp-wodify-api-cache-programs' );

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
}

/**
 * function to output intro text for the first admin section
 */
function wp_wodify_admin_section_callback ( ) {
  echo '<p>Basic information goes here</p>';
}


/**
 * function to output the api key input element on the admin page
 */
function wp_wodify_admin_api_key_field_callback ( ) {
  $setting = esc_attr( get_option( 'wp-wodify-api-key' ) );
  echo '<input type="text" name="wp-wodify-api-key" value="' . $setting . '" />';
}


/**
 * function to handle api requests
 * @param  string $api_name the short name of the api to request (i.e. 'locations')
 * @param  array  $params   Associative array of parameters to include for the api
 * @return Object the resulting json object
 */
function wp_wodify_api_request ( $api_name, $params = array() ) {
  $api_key = esc_attr( get_option( 'wp-wodify-api-key' ) );
  $data = array_merge($params, array(
    'apikey'   => $api_key,
    'type'     => 'json',
    'encoding' => 'utf-8'
  ));

  $uri = _wp_wodify_get_api_uri( $api_name );

  $ch = curl_init();

  $url = sprintf('%s?%s', $uri, http_build_query($data));

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

  $result = curl_exec($ch);

  return json_decode( $result );
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
