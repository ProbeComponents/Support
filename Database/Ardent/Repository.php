<?php
namespace Probe\Database\Ardent;


use Probe\Support\Contracts\RepositoryInterface;

use Probe\Support\Contracts\DatabaseInterface as DBI;

abstract class Repository implements RepositoryInterface{
    abstract protected DBI $db;
}