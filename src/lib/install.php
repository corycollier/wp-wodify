<?php

if (! function_exists( 'wp_wodify_uninstall' ) ) {
  /**
   * installation procedure
   */
  function wp_wodify_install ( ) {

    // really not needed here, but this is always a good housekeeping measure
    flush_rewrite_rules();
  }
}

if (! function_exists( 'wp_wodify_uninstall' ) ) {
  /**
   * uninstall procedure
   */
  function wp_wodify_uninstall ( ) {
    if (! defined('WP_UNINSTALL_PLUGIN')) {
      return;
    }

    // really not needed here, but this is always a good housekeeping measure
    flush_rewrite_rules();
  }
}
