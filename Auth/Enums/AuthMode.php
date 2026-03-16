<?php
namespace Probe\Auth\Enums;

enum AuthMode{
    case LOGIN_USERNAME;
    case LOGIN_EMAIL;
    case LOGIN_MAGIC_LINK;
    case REGISTER;
    case OAUTH;
    case OAUTH_REGISTER;
}