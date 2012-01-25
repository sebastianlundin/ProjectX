<?php

class AuthHandler
{
    public static $instance;

    public static function login($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return null;
        }
    }

    public static function isLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }

}
