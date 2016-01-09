<?php
/**
 * Fields Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Fields
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Fields Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Fields
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Fields {

    /**
     * Standard input[type=*] template.
     *
     * @param array $replacements An array of replacements to make
     *
     * @return string The markup for a standard input field.
     */
    public function get_input_field($replacements) {
        $template = '<input type="!type" name="!name" value="!value" !attribs />';
        $defaults = array(
            '!type'  => 'text',
            '!name'  => '',
            '!value' => '',
        );

        $attribs = $this->get_attribs( array_diff_key( $replacements, $defaults ) );
        $defaults['!attribs'] = $attribs;
        return strtr( $template, array_merge( $defaults, $replacements ) );
    }

    /**
     * Outputs the result of the get_input_field method.
     *
     * @param array $replacements An array of replacements to make
     */
    public function input_field($replacements) {
        echo $this->get_input_field($replacements);
    }

    /**
     * Gets a string representing key=value pairs.
     *
     * @param  array $values The array of key/value pairs.
     *
     * @return string A string of key="value" pairs.
     */
    protected function get_attribs($values) {
        $result = '';
        $sep = '';

        foreach ($values as $name => $value) {
            if (is_array($value)) {
                $value = implode(',', array_values($value));
            }
            $name = ltrim($name,'!');
            $result .= $sep . $name . '="' . $value . '"';
            $sep = ' ';
        }

        return $result;
    }




    public function admin_settings_api_key() {
        $setting = get_option( 'wp-wodify-api-key' );
        echo '<input type="text" name="wp-wodify-api-key" value="' . esc_attr( $setting ) . '" />';
    }
}
