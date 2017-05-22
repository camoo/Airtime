<?php
namespace CAMOO\HttpClients;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/HttpClients/CamooHttpClient.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CamooHttpClient
 *
 * @link http://www.camoo.cm
*/
require_once( CAMOO_ROOT_SRC_DIR .'vendor/autoload.php');

use GuzzleHttp\Exception\RequestException;
use CAMOO\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use CAMOO\Base;


class CamooHttpClient extends Base {
    const REQUEST_GET = 'GET';
    const REQUEST_POST = 'POST';
    const HTTP_NO_CONTENT = 204;
    const CLIENT_VERSION = '1.2.0';
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $userAgent = array();

    /**
     * @var int
     */
    private $timeout = 10;
    
    /**
    * @var mixed
    */
    
    private $oAuthentication = array();
    
    public $ssl_verify = false; // Verify Camoo SSL before sending any message
    
    private $oClient = null;
    private $oResponse = null;
    private $_WellKownRequestOption = ['query', 'form_params'];

    /**
     * @var int
     */
    private $connectionTimeout = 2;

    /**
     * @param int $timeout > 0
     * @param int $connectionTimeout >= 0
     *
     * @throws \HttpClientException if timeout settings are invalid
     */
    public function __construct() {
    
        $this->addUserAgentString('CAMOO/ApiClient/' . static::CLIENT_VERSION);
        $this->addUserAgentString($this->getPhpVersion());

	if ( is_null($this->oClient) ) { 
		$this->oClient = new Client();
	}
    }

    public function setConnectionTimeout($connectionTimeout) 
    {

        if (!is_int($connectionTimeout) || $connectionTimeout < 0) {
            throw new HttpClientException(sprintf(
                'Connection timeout must be an int >= 0, got "%s".',
                is_object($connectionTimeout) ? get_class($connectionTimeout) : gettype($connectionTimeout).' '.var_export($connectionTimeout, true))
            );
        }

	    $this->connectionTimeout = $connectionTimeout;
    }

    /**
     * @param string $userAgent
     */
    public function addUserAgentString($userAgent)
    {
        $this->userAgent[] = $userAgent;
    }


    public function getUserAgent() 
    {
	    return $this->userAgent;
    }

    /**
     * @param string      $method
     * @param Array $option
     *
     * @return mixed
     *
     * @throws HttpClientException
     */

    public function performRequest($sMethod, $option=array()) {
	    $this->endpoint = $this->getEndPointUrl();
	    $this->calRequestOption($sMethod, $option);

	    try {
		   $oResponse = $this->oClient->request($sMethod, $this->endpoint, $option);
		//$reason = $oResponse->getReasonPhrase(); // OK
		   if ( $oResponse->getStatusCode() === 200 ) { 
		     return $this->decode($oResponse->getBody());
		  }
		throw new HttpClientException();
	    } catch (RequestException $e) {
		    throw new HttpClientException(Psr7\str($e->getRequest()));
		    if ($e->hasResponse()) {
			throw new HttpClientException(Psr7\str($e->getResponse()));
		    }
	    }
    }

    private function calRequestOption($sMethod, &$option) {
	    $sUserAgent = implode(' ', $this->userAgent);
	    $oToken = new \CAMOO\Authentifications\Token($this);
	    $sToken = $oToken->get();

	    $defaultHeaders = [
		    'User-Agent' => $sUserAgent,
		     'Authorization' => $sToken,
		    //    'Accept'     => 'application/json',
		    'X-CAMOO'    => $this->userAgent
	    ];
        $defaults = ['headers' => $defaultHeaders];
        $option += $defaults;
    }
	
     /**
     * @return string
     */
    private function getPhpVersion() {
        if (!defined('PHP_VERSION_ID')) {
            $version = explode('.', PHP_VERSION);
            define('PHP_VERSION_ID', $version[0] * 10000 + $version[1] * 100 + $version[2]);
        }
        return 'PHP/' . PHP_VERSION_ID;
    }
}
