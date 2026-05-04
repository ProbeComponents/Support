<?php
namespace Probe\Auth\Contracts;

use Probe\Database\Ardent\Model;


interface Authenticable{
    public function find(string|int $primaryKey): Model;
    public function findByID(int $id): Model;
}