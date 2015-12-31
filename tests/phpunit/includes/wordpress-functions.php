<?php
/**
 * This file serves to define base definitions for wordpress functions.
 */

function add_action ( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {}
function register_activation_hook ( $file, $function ) {}
function register_deactivation_hook ( $file, $function ) {}
function current_user_can ( $capability ) {}
function wp_die ( ) {}
function settings_fields ( $option_group ) {}
function do_settings_sections( $page ) {}
function submit_button ( $text = null, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null ) {}
function get_option ( $option, $default = false ) {}
function register_setting ( $option_group, $option_name, $sanitize_callback = '' ) {}
function add_settings_section ( $id, $title, $callback, $page ) {}
function esc_attr ( $text ) {}
function update_option ( $option, $value, $autoload = null ) {}
function flush_rewrite_rules() {}
function register_post_type ($post_type, $args = array() ) {}
function register_taxonomy( $taxonomy, $object_type, $args = array() ) {}
function wp_remote_get( $url, $args = array() ) {}