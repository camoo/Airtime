<?php
/**
 * Copyright 2017 Camoo Sarl.
 *
 */

use PHPUnit\Framework\TestCase;
use CAMOO\Base;
use CAMOO\Exceptions\CamooException;
use CAMOO\Authentifications\Credentials;
use CAMOO\Common\CalledClass;

/**
 * @covers CAMOO\Base
 */
class BaseTest extends TestCase {

	/**
	 * @covers Base::create
	 */
	public function testCreate() 
	{
		$this->assertInstanceOf('\\CAMOO\\Base', Base::create());
	}

	/**
	 * @covers setCredentials
	 * @depends testCreate
	 * @dataProvider addProvider
	 */
	public function testsetCredentials($sApiKey, $sApiSecret)
	{
		$this->assertEquals(
			Base::create()->setCredentials($sApiKey, $sApiSecret),
			Base::create()
		);
	}

	public function addProvider()
	{

		return [                       
			['api_key', 'secret_key'],
			['api_key3', 'secret_keyr'],
			['camoo', 'php-source-code'],
		];

	}

	/**
	 * @covers getCredentials
	 */
	public function testgetCredentials() {
		$oBaseCredentials = Base::create()->setCredentials('api_key','secret_key');
		$oCredentials = $this->getMockBuilder(Credentials::class)
			->setConstructorArgs(['api_key', 'secret_key'])
			->setMethods(['toArray'])
			->getMock();

		$oCredentials->expects($this->once())
			->method('toArray')
			->with()
			->will($this->returnValue(['api_key' => 'api_key', 'api_secret' => 'secret_key']));
		$this->assertEquals($oCredentials->toArray(), $oBaseCredentials->getCredentials()->toArray());
	}

	/**
	 * @covers setResourceName
	 * @covers getResourceName
	 * @dataProvider addProviderRessourceName
	 */
	public function testSetgetResourceName($sName) 
	{
		$oBase = Base::create();
		$oBase->setResourceName($sName);
		$this->assertEquals($sName, $oBase->getResourceName());

	}

	public function addProviderRessourceName()
	{

		return [                       
			['airtime'],
			['camoo'],
			['topup'],
		];

	}

	/**
	 * @covers setModule
	 * @dataProvider addProviderSetModule
	 */
	public function testSetModule(CalledClass $oModule) 
	{
		$oCalledClassMocked = $this->getMockBuilder(CalledClass::class)
			->setConstructorArgs([$oModule->name])
			->setMethods(['toArray'])
			->getMock();

		$oCalledClassMocked->expects($this->once())
			->method('toArray')
			->with()
			->will($this->returnValue(['name' => $oModule->name]));

		$oBase = Base::create();
		$oCalledClass = $oBase->setModule($oModule);
		$this->assertEquals($oCalledClassMocked->toArray(), $oCalledClass->toArray());
	}

	public function addProviderSetModule() 
	{
		return [
			[new CalledClass('airtime')],
			[new CalledClass('camoo')],
			[new CalledClass('topup')],
		];
	}
}
