<?php
/**
 * Data Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Data
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Data Class
 *
 * Encapsulation of all Wodify Data (coaches, classes, etc)
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Data
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Data
{
    /**
     * Store an instance of the API to communicate to the api with.
     *
     * @var WpWodify\Api
     */
    protected $api;

    /**
     * Stores an instance of the Cache class.
     *
     * @var WpWodify\Cache
     */
    protected $cache;

    /**
     * Setter for the api property.
     *
     * @param WpWodify\Api $api An instance of the Api.
     *
     * @return WpWodify\Data Returns $this for object-chaining.
     */
    public function set_api( Api $api ) {
        $this->api = $api;
        return $this;
    }

    /**
     * Getter for the api property.
     *
     * @return WpWodify\Api The Api instance associated with this.
     */
    public function get_api() {
        return $this->api;
    }

    /**
     * Setter for the cache property.
     *
     * @param WpWodify\Cache $cache An instance of the Cache.
     *
     * @return WpWodify\Data Returns $this for object-chaining.
     */
    public function set_cache( Cache $cache ) {
        $this->cache = $cache;
        return $this;
    }

    /**
     * Getter for the cache property.
     *
     * @return WpWodify\Cache The Cache instance associated with this.
     */
    public function get_cache() {
        return $this->cache;
    }

    /**
     * Generic data get method.
     *
     * @param string $name The name of the data to get
     * @param array $params An array of parameters to use to find data with.
     *
     * @return array The result of the finding.
     */
    public function get( $name, $params ) {
        $cache = $this->get_cache();
        $api = $this->get_api();
        $cacheId = $cache->create_identifier(array_merge($params, array(
            'api_name' => $name,
        )));

        if ($result = $cache->get($cacheId)) {
            return $result;
        }

        $result = $api->get($name, $params);
        $cache->set($cacheId, $result);
        return $result;
    }
}