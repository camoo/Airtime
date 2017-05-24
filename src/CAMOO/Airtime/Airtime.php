<?php
namespace CAMOO\Airtime;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Airtime/Airtime.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO Airtime API
 *
 * @link http://www.camoo.cm
 */

use CAMOO\Client;
use CAMOO\Airtime\Payload;
use CAMOO\Exceptions\CamooException;

class Airtime extends Client{

	public function __construct ($api_key, $api_secret) {
		parent::__construct($api_key, $api_secret, __CLASS__);
	}

	public function __get($property) {
		$hPayload = Payload::create()->get();
		return $hPayload[$property];
	}

	public function __set($property, $value) {
		try {
		  Payload::create()->set($property, $value);
		} catch ( CamooException $err) {
		  echo $err->getMessage();
		  exit();
		}
		return $this;
	}

	private function _getAction() {
		try {
		return $this->get(Payload::create()->get());
		} catch ( CamooException $err ) {
		  echo $err->getMessage();
		  exit();
		}
	}

	public function getMsisdnInfo() {
		$this->oHttpClient->setResourceName('msisdnInfo');
		return $this->_getAction();
	}

	public function getTopupList() {
		$this->oHttpClient->setResourceName('topuplist');
		return $this->_getAction();
	}


	public function getWholeSalePriceList() {
		$this->oHttpClient->setResourceName('wholesaleprice');
		return $this->_getAction();
	}


	public function getRetailPriceList() {
		$this->oHttpClient->setResourceName('retailprice');
		return $this->_getAction();
	}

	public function send() {
		try {
		return $this->post(Payload::create()->get(true, 'send'));
		} catch ( CamooException $err) {
		  echo $err->getMessage();
		 die;
		}
	}
}
