<?php
namespace Probe\Support\Database;

use Probe\Database\Ardent\Model;

/**
 * Database ORM
 */
class Ardent{
    public function save(): Model{}
    public function update(): Model{}
    public function find(): Model{}
    public function delete(): Model{}
}