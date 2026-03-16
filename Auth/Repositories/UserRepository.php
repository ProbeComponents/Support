<?php
namespace Probe\Auth\Repositories;

use Probe\Auth\Contracts\UserRepositoryInterface;



class UserRepository extends Repository implements UserRepositoryInterface{
    protected string $table = "users";
    protected array $guarded = ["password", "password_hash"];


    public function fetchByUsername(string $username): User{

    }

    public function fetchById(string $username): Authenticable{

    }
}