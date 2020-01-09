<?php

namespace CCUPLUS\Authentication\Tests;

use CCUPLUS\Authentication\EntryPoints\Alumni;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;

class AlumniTest extends TestCase
{
    public function test_sign_in_success(): void
    {
        $response = new Response(200, ['location' => 'https://miswww1.ccu.edu.tw/alumni/alumni/mainmenu.php']);

        $guzzle = Mockery::mock(ClientInterface::class);

        $guzzle->shouldReceive('request')
            ->once()
            ->andReturn($response);

        $signedIn = (new Alumni($guzzle))->signIn('A190135784', '1234');

        $this->assertInstanceOf(CookieJar::class, $signedIn);
    }

    public function test_sign_in_fail_with_location_header(): void
    {
        $response = new Response(200, ['location' => 'https://miswww1.ccu.edu.tw/alumni/alumni/login.php']);

        $guzzle = Mockery::mock(ClientInterface::class);

        $guzzle->shouldReceive('request')
            ->once()
            ->andReturn($response);

        $signedIn = (new Alumni($guzzle))->signIn('A190135784', '1234');

        $this->assertFalse($signedIn);
    }

    public function test_sign_in_fail_without_location_header(): void
    {
        $guzzle = Mockery::mock(ClientInterface::class);

        $guzzle->shouldReceive('request')
            ->once()
            ->andReturn(new Response);

        $signedIn = (new Alumni($guzzle))->signIn('A190135784', '1234');

        $this->assertFalse($signedIn);
    }
}
