<?php
namespace Probe\Database\Ardent;

use ReflectionClass;
use Probe\Contracts\Model as Contract;

class Model implements Contract{
    protected string $table;
    public function __construct(?string $table = NULL){
        $this->table = $this->assertTableName();
    }

    final protected function assertTableName(): string{
        $name = new ReflectionClass($this)->getShortName();
        $possibleTableNames = [
            $name,
            ucfirst($name),
            strtolower($name),
        ];
    }
}