<?php
namespace Probe\Contracts;

interface Database{
    public function fetch(string $query): Model;
}