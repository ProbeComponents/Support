<?php
namespace Probe\Auth\Enums;

enum EnvironmentVariable:string{

    /** GOOGLE OAUTH */
    /**
     * A boolean value to determine whether or not Google Oauth is enabled
     * @var bool
     */
    case GOOGLE_OAUTH = "GOOGLE_OAUTH";
    /**
     * The google secret for OAUTH
     * @var string
     */
    case GOOGLE_OAUTH_SECRET = "GOOGLE_OAUTH_SECRET";
    /**
     * URL for Google OAuth
     * @var string
     */
    case GOOGLE_OAUTH_ENDPOINT = "GOOGLE_OAUTH_ENDPOINT";



    /** GITHUB OAUTH */
    /**
     * A boolean value to determine whether or not GITHUB Oauth is enabled
    */
    case GITHUB_OAUTH = "GITHUB_OAUTH";
    case GITHUB_OAUTH_SECRET = "GITHUB_OAUTH_SECRET";
    /**
     * URL for Github OAuth
     * @var string
     */
    case GITHUB_OAUTH_ENDPOINT = "GITHUB_OAUTH_ENDPOINT";



    case MAGIC_LINK_SECRET_LENGTH = "MAGIC_LINK_SECRET_LENGTH";
    case USER_UNIQUE_ID_LENGTH = "USER_UNIQUE_ID_LENGTH";
    case REGISTER_PAGE_PATH = "REGISTER_PAGE_PATH";
    case USERS_TABLE = "USERS_TABLE";


    // PATBASE
    case DB_DRIVER = "DB_DRIVER";
    case DB_NAME = "DB_NAME";
    case DB_HOST = "DB_HOST";
    case DB_USER = "DB_USER";
    case DB_PASS = "DB_PASS";
    case DB_PORT = "DB_PORT";
    case DB_FETCH_MODE = "DB_FETCH_MODE";
    case PATBASE_LAZYLOAD = "PATBASE_LAZYLOAD";
}