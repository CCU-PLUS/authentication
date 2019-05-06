<?php

namespace CCUPLUS\Authentication;

use GuzzleHttp\Cookie\CookieJar as Cookie;
use GuzzleHttp\Cookie\SetCookie;
use InvalidArgumentException;

class Authentication
{
    /**
     * Entry point namespace.
     *
     * @var string
     */
    const NAMESPACE = 'CCUPLUS\Authentication\EntryPoints\\';

    /**
     * 保存 target 值之 cookie 名稱.
     *
     * @var string
     */
    const TARGET = '_target_';

    /**
     * 驗證用戶登入.
     *
     * @param string $username
     * @param string $password
     * @param string $target
     *
     * @return Cookie|false
     */
    public function signIn(string $username, string $password, string $target)
    {
        $class = sprintf(
            '%s%s',
            self::NAMESPACE,
            $target = ucfirst(mb_strtolower($target))
        );

        if (!class_exists($class)) {
            throw new InvalidArgumentException(
                sprintf('%s is not a valid entry point.', $target)
            );
        }

        /** @var Cookie|false $cookie */

        $cookie = (new $class)->signIn($username, $password);

        if (false === $cookie) {
            return false;
        }

        $cookie->setCookie($this->targetCookie($target));

        return $cookie;
    }

    /**
     * 設置 target cookie.
     *
     * @param string $target
     *
     * @return SetCookie
     */
    protected function targetCookie(string $target): SetCookie
    {
        $cookie = new SetCookie;

        $cookie->setName(self::TARGET);

        $cookie->setValue($target);

        return $cookie;
    }

    /**
     * 登出用戶.
     *
     * @param Cookie $jar
     *
     * @return bool
     */
    public function signOut(Cookie $jar): bool
    {
        $cookie = $jar->getCookieByName(self::TARGET);

        $target = $cookie->getValue();

        $class = sprintf('%s%s', self::NAMESPACE, $target);

        return (new $class)->signOut($jar);
    }
}
