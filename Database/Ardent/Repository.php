<?php
namespace Probe\Database\Ardent;


use Probe\Contracts\Repository as RepositoryInterface;

use Probe\Contracts\DatabaseInterface as DBI;

abstract class Repository implements RepositoryInterface{
    abstract protected DBI $db;
}