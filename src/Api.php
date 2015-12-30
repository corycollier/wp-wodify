<?php
/**
 * Api Class
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Api
 * @since       File available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace WpWodify;

/**
 * Api Class
 *
 * Encapsulation of all things related to connecting to the Wodify API.
 *
 * @category    PHP
 * @package     WpWodify
 * @subpackage  Api
 * @since       Class available since release 1.0.x
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Api
{
    const ERR_API_NOT_AVAILABLE = 'The given api [%s], does not exist';

    /**
     * Stores the API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * A list of endpoints available.
     *
     * @var array
     */
    protected $endpoints = array(
        'classes'      => 'http://app.wodify.com/API/Classes_v1.aspx',
        'coaches'      => 'http://app.wodify.com/API/Coaches_v1.aspx',
        'leaderboards' => 'http://app.wodify.com/API/Leaderboard_v1.aspx',
        'results'      => 'http://app.wodify.com/API/LeaderboardResults_v1.aspx',
        'locations'    => 'http://app.wodify.com/API/Locations_v1.aspx',
        'programs'     => 'http://app.wodify.com/API/Programs_v1.aspx',
        'whitebaord'   => 'http://app.wodify.com/API/Whiteboard_v1.aspx',
    );

    /**
     * Getter for the apiKey attribute.
     *
     * @return string The API key.
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Setter for the apiKey attribute.
     *
     * @param string $apiKey The value to set the apiKey to.
     *
     * @return WpWodify\Api Returns $this for object-chaining.
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Gets the full uri for a given api name.
     *
     * @param $name The name of the api to get a uri for.
     *
     * @return string The full uri for the api.
     */
    public function getApiUri($name)
    {
        $name = strtolower($name);
        if (!array_key_exists( $name, $this->endpoints ) ) {
            throw new Exception( sprintf(self::ERR_API_NOT_AVAILABLE, $name ) );
        }
        return $this->endpoints[$name];
    }

    /**
     * Gets a result for a given api.
     *
     * @param string $apiName The name of the api to connect to.
     * @param array $params Parameters to pass to build a query.
     *
     * @return string The result.
     */
    public function get($apiName, $params)
    {
        $apiKey = $this->getApiKey();
        $uri = $this->getApiUri( $apiName );
        $data    = array_merge( $params, array(
            'apikey'   => esc_attr( $apiKey ),
            'type'     => 'json',
            'encoding' => 'utf-8',
        ));
        $uri = sprintf( '%s?%s', $uri, http_build_query( $data ) );
        $result = wp_remote_get( $uri );
        return $result;
    }

}