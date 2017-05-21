<?php
namespace CAMOO;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Client.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO API Client
 *
 * @link http://www.camoo.cm
*/

use CAMOO\Base;
use CAMOO\Common\CalledClass;
use CAMOO\Exceptions\HttpClientException;

class Client {
	protected $oHttpClient;
	const REQUEST_GET = 'GET';
	const REQUEST_POST = 'POST';

	public function __construct ($api_key, $api_secret, $sClass=null) {
		if ( is_null($this->oHttpClient) ) {
			$this->oHttpClient = (new HttpClients\CamooHttpClient())->setCredentials($api_key, $api_secret);
			if ( $sClass !== null ) {$this->oHttpClient->setModule(new \CAMOO\Common\CalledClass($sClass));}
		}
	}

	public function post($data=[]) {
		return $this->oHttpClient->performRequest(static::REQUEST_POST, ['form_params' => $data]);
	}

	public function get($data=[]) {
		return $this->oHttpClient->performRequest(static::REQUEST_GET, ['query' => $data]);
	}
}
