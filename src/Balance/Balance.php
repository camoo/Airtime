<?php
namespace CAMOO\Balance;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Balance/Balance.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO Airtime API
 *
 * @link http://www.camoo.cm
*/

use CAMOO\Client;
use CAMOO\Balance\Validate;
use CAMOO\Exceptions\CamooException;

class Balance extends Client{

    public function __construct ($api_key, $api_secret) {
	parent::__construct($api_key, $api_secret, __CLASS__);
    }

    /**
    * read the current user balance
    * @return mixed Balance
    */
     public function current() {
	  return $this->get();
    }


    /**
    * Initiate a recharge for an user account
    * Only available for MTN Mobile Money Cameroon
    *
    * @param $hData, ['phonenumber' => '671234567', 'amount' => 1000]
    * @return mixed Trx
    */
     public function add($hData) {
	$this->oHttpClient->setResourceName('topup');
	$oValidator = (new Validate())->addBalance($hData);
	if ( $oValidator->validate() === false ) {
		throw new CamooException($oValidator->errors());
	}
	return $this->post($hData);
    }
}
