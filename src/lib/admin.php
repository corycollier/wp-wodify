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
  // register_setting( 'my-settings-group', 'my-setting' );
  // add_settings_section( 'section-one', 'Section One', 'section_one_callback', 'my-plugin' );
  // add_settings_field( 'field-one', 'Field One', 'field_one_callback', 'my-plugin', 'section-one' );

  register_setting(
    'wp-wodify-settings-group',
    'wp-wodify-api-key'
  );

  add_settings_section(
    'section-one',
    'Section One',
    'wp_wodify_admin_section_callback',
    'wp-wodify-administer'
  );

  add_settings_field(
    'wp-wodify-api-key',
    'Api Key',
    'wp_wodify_admin_api_key_field_callback',
    'wp-wodify-administer',
    'section-one'
  );
}

/**
 * function to output intro text for the first admin section
 */
function wp_wodify_admin_section_callback ( ) {
  echo '<p>basic information goes here</p>';
}

/**
 * function to output the api key input element on the admin page
 */
function wp_wodify_admin_api_key_field_callback ( ) {
  // $setting = esc_attr( get_option( 'my-setting' ) );
  // echo "<input type='text' name='my-setting' value='$setting' />";

  $setting = esc_attr( get_option( 'wp-wodify-api-key' ) );
  echo '<input type="text" name="wp-wodify-api-key" value="' . $setting . '" />';
}