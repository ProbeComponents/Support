<?php
namespace Probe\Database\Ardent\Migrations;




/**
 * @method Column integer()
 * @method Column bigInteger()
 * @method Column tinyInteger()
 * @method Column smallInteger()
 * @method Column mediumInteger()
 * @method Column decimal()
 * @method Column float()
 * @method Column double()
 * @method Column boolean()
 * @method Column string()
 * @method Column char()
 * @method Column text(string $name)
 * @method Column mediumText()
 * @method Column longText()
 * @method Column tinyText()
 * @method Column date()
 * @method Column dateTime()
 * @method Column timestamp()
 * @method Column time()
 * @method Column year()
 * @method Column binary()
 * @method Column blob()
 * @method Column json()
 * @method Column uuid()
 * @method Column ulid()
 * @method Column enum()
 * @method Column set()
 * @method Column ipAddress()
 * @method Column macAddress()
 * @method Column geometry()
 * @method Column point()
 * @method Column vector()
 */
class Table{
    /**
     * An array of Column objects with rules to apply on migration
     * @var Column[]
     */
    public array $columns = [];

    /**
     * An annonymous function that specifies the structure of the column
     * * `AKA The ruleset for the column`
     * @var \Closure(static): void $blueprint
     */
    protected \Closure $blueprint;

    public function __construct(protected string $name){}

    /**
     * @param \Closure(static): void $blueprint
     */
    public function schema(\Closure $blueprint): static{
        $blueprint($this);
        return $this;
    }


    public function __call($type, $args): Column{
        $column =  new Column(name: $args[0]);
        $this->columns[] = $column;
        return $column->$type();
    }

    public function id(): Column{
        return $this->__call("int", ["id"]);
    }
}