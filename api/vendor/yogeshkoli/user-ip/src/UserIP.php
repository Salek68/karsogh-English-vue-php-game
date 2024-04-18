<?php

namespace YogeshKoli\UserIP;

/**
 * Class UserIP
 * @package YogeshKoli\UserIP
 */
class UserIP
{

    /**
     * @var null
     */
    private static $ip = NULL;


    /**
     * Get Current Active Client IP Address
     *
     * @return bool|null|string
     */
    public static function get()
    {
        if (!isset(self::$ip)) {
            self::$ip = self::_check_ip();
        }

        return self::$ip;
    }

    /**
     * @param $name
     *
     * @return string
     */
    private static function _get($name)
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER[$name])) {
                return $_SERVER[$name];
            }
        } else {
            if (getenv($name)) {
                return getenv($name);
            }
        }

        return FALSE;
    }

    /**
     * @return bool|string
     */
    private static function _check_ip()
    {
        if (self::_get('HTTP_X_FORWARDED_FOR')) {
            return self::_get('HTTP_X_FORWARDED_FOR');
        } else if (self::_get('HTTP_CLIENT_IP')) {
            return self::_get('HTTP_CLIENT_IP');
        } else if (self::_get('REMOTE_ADDR')) {
            return self::_get('REMOTE_ADDR');
        } else if (self::_get('HTTP_X_FORWARDED')) {
            return self::_get('HTTP_X_FORWARDED');
        } else if (self::_get('HTTP_FORWARDED_FOR')) {
            return self::_get('HTTP_FORWARDED_FOR');
        } else if (self::_get('HTTP_FORWARDED')) {
            return self::_get('HTTP_FORWARDED');
        } else {
            return 'UNKNOWN';
        }
    }

    /**
     * Validate Given IP Address
     *
     * @param $ip
     *
     * @return bool
     */
    public static function validate($ip)
    {
        return (filter_var($ip, FILTER_VALIDATE_IP)) ? TRUE : FALSE;
    }
}