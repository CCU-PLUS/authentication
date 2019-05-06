<?php

namespace CCUPLUS\Authentication\EntryPoints;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar as Cookie;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;

abstract class EntryPoint
{
    /**
     * Guzzle Http Client instance.
     *
     * @var Client
     */
    protected $guzzle;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->guzzle = new Client;
    }

    /**
     * 登入服務.
     *
     * @param string $username
     * @param string $password
     *
     * @return Cookie|false
     */
    public function signIn(string $username, string $password)
    {
        try {
            $response = $this->guzzle->post($this->signInUrl(), [
                'allow_redirects' => false,
                'connect_timeout' => 2,
                'cookie' => $cookie = new Cookie,
                'form_params' => $this->signInForm($username, $password),
                'timeout' => 3,
            ]);
        } catch (TransferException $e) {
            return false;
        }

        return $this->signedIn($response) ? $cookie : false;
    }

    /**
     * 登出.
     *
     * @param Cookie $cookie
     *
     * @return bool
     */
    public function signOut(Cookie $cookie): bool
    {
        try {
            $this->guzzle->get($this->signOutUrl(), [
                'connect_timeout' => 1,
                'cookie' => $cookie,
                'timeout' => 2,
            ]);
        } catch (TransferException $e) {
            return false;
        }

        return true;
    }

    /**
     * 登入網址.
     *
     * @return string
     */
    abstract protected function signInUrl(): string;

    /**
     * 登入表單.
     *
     * @param string $username
     * @param string $password
     *
     * @return array
     */
    abstract protected function signInForm(string $username, string $password): array;

    /**
     * 檢查是否登入成功.
     *
     * @param ResponseInterface $response
     *
     * @return bool
     */
    abstract protected function signedIn(ResponseInterface $response): bool;

    /**
     * 登出網址.
     *
     * @return string
     */
    abstract protected function signOutUrl(): string;
}
