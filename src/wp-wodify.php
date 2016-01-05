<?php
/*
Plugin Name: WP Wodify
Plugin URI:  https://github.com/corycollier/wp-wodify
Description: Plugin to integrate Wodify with Wordpress
Version:     1.0.0
Author:      Cory Collier
Author URI:  http://corycollier.com
License:     MIT
License URI: http://opensource.org/licenses/MIT
Domain Path: /languages
Text Domain: wp-wodify

The MIT License (MIT)

Copyright (c) @year@ Cory Collier

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

// require_once 'lib/install.php';
// require_once 'lib/posts.php';
// require_once 'lib/admin.php';

// // register the activation / deactivation hooks
// register_activation_hook( __FILE__, 'wp_wodify_install' );
// register_deactivation_hook( __FILE__, 'wp_wodify_uninstall' );

// add the menu for the admin page
// add_action( 'admin_menu', 'wp_wodify_admin_menu' );
// add_action( 'admin_init', 'wp_wodify_admin_init' );

require_once 'lib/class-api.php';
require_once 'lib/class-cache.php';
require_once 'lib/class-data.php';
require_once 'lib/class-exception.php';
require_once 'lib/class-installer.php';
require_once 'lib/class-loader.php';
require_once 'lib/class-overlord.php';
require_once 'lib/class-template.php';

$overlord = WpWodify\Overlord::getInstance();
if ( PHP_SAPI !== 'cli' ) {
  $overlord->run();
}