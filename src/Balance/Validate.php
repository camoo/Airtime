<?php
namespace CAMOO\Balance;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Balance/Validate.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO Balance API Validate
 *
 * @link http://www.camoo.cm
 */

use Valitron\Validator;

/**
* Class Validate
*/
class Validate {

	public function addBalance($hData) {
		$oValidator = new Validator($hData);
		$oValidator
			->rule('required', ['phonenumber', 'amount']);

		$oValidator
			->rule('integer','amount', 'amount');

		$this->notEmptyRule($oValidator, 'phonenumber');
		$this->notEmptyRule($oValidator, 'amount');
		$this->isCMMTN($oValidator, 'phonenumber');
		return $oValidator;
	}

	/**
	* @guide https://en.wikipedia.org/wiki/Telephone_numbers_in_Cameroon
	*/
	private function isCMMTN(&$oValidator, $sParam) {
		$oValidator
		   ->rule(function($field, $value, $params, $fields) {
        	     return (boolean) preg_match('/^(67|650|651|652|653|654)\s*/', $value);
	   }, $sParam)->message("{field} is not a MTN Cameroon phonenumber...");
	}


	private function notEmptyRule(&$oValidator, $sParam) {
		$oValidator
			->rule(function($field, $value, $params, $fields) {
			if (is_null($value) || empty($value) ) {
				return false;
			} elseif (is_string($value) && trim($value) === '') {
				return false;
			}
			return true;
		}, $sParam)->message("{field} can not be blank/empty...");
	}
}
