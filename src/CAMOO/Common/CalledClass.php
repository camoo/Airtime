<?php
namespace CAMOO\Common;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Authentifications/CalledClass.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO API Called Class
 *
 * @link http://www.camoo.cm
 */


/**
 * Class CalledClass
 *
 * @package CAMOO\Common
 */
class CalledClass
{
	public $name;

	/**
	 * @param $sCalledClass
	 */
	public function __construct($sCalledClass)
	{
		$this->name = $this->getRelativeClassName($sCalledClass);
	}

	public function toArray() {
		return (array) $this;
	}

	private function getRelativeClassName($sClass) {
		$asClassExploded = explode('\\', $sClass);
		$sModuleName = end($asClassExploded);
		return strtolower($sModuleName);
	}
}
