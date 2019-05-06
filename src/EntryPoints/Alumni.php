<?php

namespace CCUPLUS\Authentication\EntryPoints;

use Psr\Http\Message\ResponseInterface;

class Alumni extends EntryPoint
{
    /**
     * 登入網址.
     *
     * @return string
     */
    protected function signInUrl(): string
    {
        return 'https://miswww1.ccu.edu.tw/alumni/alumni/login.php';
    }

    /**
     * 登入表單.
     *
     * @param string $username
     * @param string $password
     *
     * @return array
     */
    protected function signInForm(string $username, string $password): array
    {
        return [
            'id' => $username,
            'password' => $password,
        ];
    }

    /**
     * 檢查是否登入成功.
     *
     * @param ResponseInterface $response
     *
     * @return bool
     */
    protected function signedIn(ResponseInterface $response): bool
    {
        $locations = $response->getHeader('location');

        if (!isset($locations[0])) {
            return false;
        }

        return false !== mb_strpos($locations[0], 'mainmenu.php');
    }

    /**
     * 登出網址.
     *
     * @return string
     */
    protected function signOutUrl(): string
    {
        return 'https://miswww1.ccu.edu.tw/alumni/alumni/logout.php';
    }
}