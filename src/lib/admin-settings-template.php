<?php
/**
 * The template for displaying Admin settings
 *
 * @package     WpWodify
 * @subpackage  Template
 * @since       File available since release 1.0.x
 */
?>

<div class="wrap">
    <h2>WP Wodify Settings</h2>
    <p>Change and update settings for Wodify integration here</p>
    <form action="options.php" method="POST">
        <?php settings_fields( 'wp-wodify-settings-group' ); ?>
        <?php do_settings_sections( 'wp-wodify-administer' ); ?>
        <?php submit_button(); ?>
    </form>
</div>

<div class="wrap">
    <h2>API Synchronize</h2>
    <p>Use the buttons below to synchronize various parts of the Wodify API</p>

    <form action="<?php echo esc_attr( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="wp_wodify_classes_sync">
        <?php submit_button( 'Synchronize Classes' ); ?>
    </form>

    <form action="<?php echo esc_attr( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="wp_wodify_coaches_sync">
        <?php submit_button( 'Synchronize Coaches' ); ?>
    </form>

    <form action="<?php echo esc_attr( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="wp_wodify_locations_sync">
        <?php submit_button( 'Synchronize Locations' ); ?>
    </form>

    <form action="<?php echo esc_attr( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="wp_wodify_programs_sync">
        <?php submit_button( 'Synchronize Programs' ); ?>
    </form>

</div>
