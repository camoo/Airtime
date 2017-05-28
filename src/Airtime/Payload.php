<?php
namespace CAMOO\Airtime;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Airtime/Payload.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO Airtime API Payload
 *
 * @link http://www.camoo.cm
 */

use Valitron\Validator;
use CAMOO\Exceptions\CamooException;

final class Payload{

	private $destination_msisdn = null;
	private $msisdn = null;
	private $topup = null;
	private $send_sms = false;
	private $sms = null;
	private $test_mode = false;
	private $id = 0;
	protected static $_create = null;

	public static function create()
	{
		if ( is_null(static::$_create) )
		{
			static::$_create = new self;
		}
		return static::$_create;
	}

	private function ValidatorDefault(Validator $oValidator) {
		$oValidator
			->rule('required', ['destination_msisdn']);
		return $oValidator;
	}


	private function ValidatorView(Validator $oValidator) {
		$oValidator
			->rule('required', ['id']);

		$oValidator
			->rule('integer', 'id');

		$this->notBlankRule($oValidator, 'id');
		return $oValidator;
	}

	private function ValidatorSend(Validator $oValidator) {
		$oValidator
			->rule('required', ['destination_msisdn', 'topup', 'msisdn']);
		$oValidator
			->rule('optional', ['sms', 'sender_sms', 'test_mode']);

		$oValidator
			->rule('boolean', 'send_sms');
		$oValidator
			->rule('boolean', 'sender_sms');
		$oValidator
			->rule('boolean', 'test_mode');
		$this->notBlankRule($oValidator, 'topup');
		return $oValidator;
	}

	private function notBlankRule(&$oValidator, $sParam) {
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



	public function set($sProperty, $value) {
		if ( !property_exists($this, $sProperty) ) {
		  throw new CamooException([$sProperty => 'is not allowed!']);
		}
		$this->$sProperty = $value;
	}

	public function get($validate=true, $validator='default') {
		$hPayload = get_object_vars($this);
		if ( $validate === true && method_exists($this, 'Validator' .ucfirst($validator)) ) {
			$sValidator = 'Validator' .ucfirst($validator);
			$oValidator = $this->$sValidator(new Validator($hPayload));
			if ( $oValidator->validate() === false ) {
				throw new CamooException($oValidator->errors());
			}

		}
		return $hPayload;
	}

	protected function __clone() {}

	/**
	 * constructor
	 *
	 */
	protected function __construct() {
	}
}
