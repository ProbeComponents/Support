<?php
namespace Probe\Contracts;

interface Model{
    protected static function table(): string;
    protected static function defaultTableName(): string;
}