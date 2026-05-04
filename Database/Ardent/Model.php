<?php
namespace Probe\Database\Ardent;

use Probe\Support\Facades\DB;
use ReflectionClass;
use Probe\Contracts\Model as Contract;

class Model implements Contract{
    protected static string $table;

    public static function find(): self{
        DB::select("*")->from(static::table())->where(UsersTable::ID);
    }

    final protected static function defaultTableName(): string{
        return ucfirst(new ReflectionClass(objectOrClass: static::class)->getShortName());
    }

    final protected static function table(): string{
        return static::$table ?? self::defaultTableName();
    }
}