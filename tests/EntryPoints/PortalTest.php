<?php

namespace CCUPLUS\Authentication\Tests;

use \Mockery;
use PHPUnit\Framework\TestCase;
use CCUPLUS\Authentication\EntryPoints\Portal;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;

class PortalTest extends TestCase
{
	/**
	 * @dataProvider provider
	 */
	public function test_sign_in($location, $signed)
	{
		$header = ['location' => $location];
		$response = new Response(200, $header, '', '1.1');

		$guzzle = Mockery::mock(ClientInterface::class);
		$guzzle->shouldReceive('request')
			->once()
			->andReturn($response);

		$portal = new Portal($guzzle);

		$this->assertEquals(
			$signed,
			($portal->signIn('401110001', '1234') instanceof \GuzzleHttp\Cookie\CookieJar)
		);
	}

	public function provider()
	{
		return [
			['https://portal.ccu.edu.tw/sso_index.php', true],
			['https://portal.ccu.edu.tw/login_check.php', false]
		];
	}
}
