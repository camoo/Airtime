<?php
/**
 * Copyright 2017 Camoo Sarl.
 *
 */

use PHPUnit\Framework\TestCase;
use CAMOO\Balance\Balance;
use CAMOO\Exceptions\CamooException;
/**
 * @covers CAMOO\Balance\Balance
 */
class BalanceTest extends TestCase {

	public function testInstance() 
	{
		$oBalance = new Balance('api_key', 'secret_key');
		$this->assertInstanceOf('\\CAMOO\\Balance\\Balance',$oBalance);
	}

	/**
	 * @covers Balance::current
	 * @depends testInstance
	 */
	public function testCurrent() {
		$oBalance = new Balance('api_key', 'secret_key');
		$this->assertInstanceOf('stdClass',$oBalance->current());
	}


	/**
	 * @covers Balance::add
	 * @depends testInstance
	 * @dataProvider addProviderSuccess
	 */
	public function testAddSuccess($hData) {
		$oBalance = new Balance('api_key', 'secret_key');
		$this->assertInstanceOf('stdClass',$oBalance->add($hData));
	}

	public function addProviderSuccess()
	{

		return [                       
			[ ['phonenumber' => 671234567,'amount' => '1000']],
			[ ['phonenumber' => 650234567,'amount' =>  10000 ]],
			[ ['phonenumber' => 651234567,'amount' =>  1000 ]],
			[ ['phonenumber' => 652234567,'amount' => '1500']],
			[ ['phonenumber' => 653234567,'amount' => '3000']],
			[ ['phonenumber' => 654234567,'amount' => '500']],
		];

	}


	/**
	 * @covers Balance::add
	 * @depends testInstance
	 * @dataProvider addProviderFailure
	 */
	public function testAddFailure($hData) {
		$oBalance = new Balance('api_key', 'secret_key');
		$this->expectException(CamooException::class);
		$oBalance->add($hData);
	}

	public function addProviderFailure()
	{

		return [                       
			[ ['phonenumbe' => 671234567,'amount' => '1000']],
			[ ['phonenumbr' => 650234567,'amount' =>  10000 ]],
			[ ['phonenmber' => 651234567,'amount' =>  '35o' ]],
			[ ['phonnumber' => 652234567,'amount' => '1500']],
			[ ['ponenumber' => 653234567,'amount' => '3000']],
			[ ['phonenumber' => 694234567,'amount' => '500']],
			[ ['phonenumber' => 654234567,'amoun1' =>  750]],
		];

	}
}
