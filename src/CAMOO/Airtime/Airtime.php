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

class Airtime extends Client{

    public function __construct ($api_key, $api_secret) {
	parent::__construct($api_key, $api_secret, __CLASS__);
    }


     public function getMsisdnInfo($sPhone) {
	$this->oHttpClient->setResourceName('msisdnInfo');
	return $this->get(['phone' => $sPhone]);

     }


}
