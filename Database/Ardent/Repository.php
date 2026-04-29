<?php
namespace Probe\Database\Ardent;


use Probe\Contracts\RepositoryInterface;

use Probe\Contracts\DatabaseInterface as DBI;

abstract class Repository implements RepositoryInterface{
    abstract protected DBI $db;
}