<?php
namespace Probe\Contracts;

interface DatabaseInterface{
    public function fetch(string $query): Model;
}