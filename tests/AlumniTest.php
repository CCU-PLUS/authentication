<?php

namespace CCUPLUS\Authentication\Tests;

use \Mockery;
use PHPUnit\Framework\TestCase;
use CCUPLUS\Authentication\EntryPoints\Alumni;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;

class AlumniTest extends TestCase
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

		$alumni = new Alumni($guzzle);

		$this->assertEquals(
			$signed,
			($alumni->signIn('A190135784', '1234') instanceof \GuzzleHttp\Cookie\CookieJar)
		);
	}

	public function provider()
	{
		return [
			['https://miswww1.ccu.edu.tw/alumni/alumni/mainmenu.php', true],
			['https://miswww1.ccu.edu.tw/alumni/alumni/login.php', false]
		];
	}
}
