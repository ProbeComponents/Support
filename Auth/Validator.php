<?php
namespace Probe\Auth;

use Probe\Support\Database\DBO;
use Probe\Auth\Enums\AuthMode;

abstract class Validator{
    private static DBO $db;

    public static function init(DBO $db){
        self::$db = $db;
    }

    /**
     * Used to mitigate unnecessary database hits
     * @param array $credentials
     * @param AuthMode $authMode
     * @return bool
     */
    public static function validateLoginDetails(array $credentials, AuthMode $authMode): bool{
        return match($authMode){
            AuthMode::LOGIN_USERNAME => static::validateUsernameLogin($credentials),
            AuthMode::LOGIN_EMAIL => static::validateEmailLogin($credentials),
            AuthMode::LOGIN_MAGIC_LINK => static::validateMagicLinkLogin($credentials),
        };
    }

    // Helper function to reduce boilerplate
    private static function validatePassword(string $password){
        if (strlen($password) < 8){
            return false;
        }
        return true;
    }

    public static function validateUsernameLogin(array $credentials): bool{
        $username = $credentials["username"];
        $password = $credentials["password"];
        if (strlen($username) < 8){
            return false;
        }
        return static::validatePassword($password);
    }
    public static function validateEmailLogin(array $credentials): bool{
        $email = $credentials["email"];
        $password = $credentials["password"];
        // If the email is an invalid format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return self::validatePassword($password);
    }

    /**
     * Determines whether the secret provided is of the expected format and exists in the database
     * @param array $credentials
     * @return bool
     */
    public static function validateMagicLinkLogin(array $credentials): bool{
        $secret = $credentials["secret"];
        if (strlen($secret) < env("MAGIC_LINK_SECRET_LENGTH")){
            return false;
        }
        return true;
    }

}