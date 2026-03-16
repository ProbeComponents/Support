<?php
namespace Probe\Auth\Services;

use Probe\Auth\Repositories\UserRepository;
use Probe\Support\Facades\DB as DBFacade;

class AuthService{
    public function __construct(
        DBFacade $db,
        UserRepository $userRepository,
    ){}
}