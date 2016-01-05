<?php
/**
 * Cache Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Cache
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Cache Class
 *
 * Encapsulation of all things related to Caching data
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Cache
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Cache {
    /**
     * Setter for the cache.
     *
     * @param string $name The name to store the data as.
     * @param mixed $data The value of the data to store.
     *
     * @return WpWodify\Cache Returns $this, for object-chaining.
     */
    public function set( $name, $data = null ) {
        return $this;
    }

    /**
     * Gets a cache value for a given name value.
     *
     * @param string $name the name of the cache to retrieve.
     *
     * @return mixed The value for the cache.
     */
    public function get( $name ) {
        return false;
    }

    /**
     * Creates a ID from an array of parameters.
     *
     * @param array $params An array of arbitrary parameters.
     *
     * @return string The identifier to match the parameters.
     */
    public function create_identifier( $params ) {
        $result = '';
        $sep = '';
        foreach ( $params as $key => $value ) {
            $result .= $sep . $key . '-' . $value;
            $sep = '-';
        }
        return $result;
    }
}