<?php
namespace Probe\Support\Contracts;

interface DatabaseInterface{
    public function fetch(string $query): Model;
}