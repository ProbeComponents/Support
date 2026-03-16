<?php
namespace Probe\Auth\Contracts;

use Probe\Auth\Contracts\Authenticable;


interface UserRepositoryInterface{
    public function findByEmail(string $email): ?Authenticable;
}