<?php
namespace Probe\Contracts;


interface Collection{
    public function append(mixed $item): static;
    public function map(callable $callable): static;
}