<?php
namespace CAMOO\Authentifications;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Authentifications/Token.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO API generate auth Token
 *
 * @link http://www.camoo.cm
 */

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * Class Token
 *
 * @package CAMOO\Authentifications
 */
class Token
{
	private $credentials;
	private $client;
	public function __construct(\CAMOO\HttpClients\CamooHttpClient $oClient)
	{
		$this->client = $oClient;
		$this->credentials = $this->client->getCredentials();
	}

	public function get()
	{
		$asIssuer = $this->client->getUserAgent();
		$sIssuer = implode(' ', $asIssuer);
		$token = (new Builder())->setIssuer($sIssuer)
			->setAudience($this->client->getEndPointUrl())
			->setId($this->credentials->api_key, true) 
			->setIssuedAt(time())
			->setNotBefore(time() + 60)
			->setExpiration(time() + 3600)
			->sign(new Sha256(), $this->credentials->api_secret)
			->getToken();
		return $token;
	}
}
