<?php
namespace CAMOO\Authentifications;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Authentifications/Credentials.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO API Client
 *
 * @link http://www.camoo.cm
*/

/**
 * Class Credentials
 *
 * @package CAMOO\Authentifications
 */
class Credentials
{
	public $api_key;
	public $api_secret;

	/**
	 * @param $sApiKey
	 * @param $sApiSecret
	 */
	public function __construct($sApiKey, $sApiSecret)
	{
		$this->api_key = $sApiKey;
		$this->api_secret = $sApiSecret;
	}

	public function toArray() {
		return (array) $this;
	}
}
