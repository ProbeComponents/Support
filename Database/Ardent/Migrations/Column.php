<?php
namespace Probe\Database\Ardent\Migrations;

use Probe\Database\Ardent\Migrations\Enums\ColumnType;


/**
 * @method id() Sets the `$type` to `ColumnType::Id`
 * @method integer() Sets the `$type` to `ColumnType::Integer`
 * @method bigInteger() Sets the `$type` to `ColumnType::BigInteger`
 * @method tinyInteger() Sets the `$type` to `ColumnType::TinyInteger`
 * @method smallInteger() Sets the `$type` to `ColumnType::SmallInteger`
 * @method mediumInteger() Sets the `$type` to `ColumnType::MediumInteger`
 * @method decimal() Sets the `$type` to `ColumnType::Decimal`
 * @method float() Sets the `$type` to `ColumnType::Float`
 * @method double() Sets the `$type` to `ColumnType::Double`
 * @method boolean() Sets the `$type` to `ColumnType::Boolean`
 * @method string() Sets the `$type` to `ColumnType::String`
 * @method char() Sets the `$type` to `ColumnType::Char`
 * @method text() Sets the `$type` to `ColumnType::Text`
 * @method mediumText() Sets the `$type` to `ColumnType::MediumText`
 * @method longText() Sets the `$type` to `ColumnType::LongText`
 * @method tinyText() Sets the `$type` to `ColumnType::TinyText`
 * @method date() Sets the `$type` to `ColumnType::Date`
 * @method dateTime() Sets the `$type` to `ColumnType::DateTime`
 * @method timestamp() Sets the `$type` to `ColumnType::Timestamp`
 * @method time() Sets the `$type` to `ColumnType::Time`
 * @method year() Sets the `$type` to `ColumnType::Year`
 * @method binary() Sets the `$type` to `ColumnType::Binary`
 * @method blob() Sets the `$type` to `ColumnType::Blob`
 * @method json() Sets the `$type` to `ColumnType::Json`
 * @method uuid() Sets the `$type` to `ColumnType::Uuid`
 * @method ulid() Sets the `$type` to `ColumnType::Ulid`
 * @method enum() Sets the `$type` to `ColumnType::Enum`
 * @method set() Sets the `$type` to `ColumnType::Set`
 * @method ipAddress() Sets the `$type` to `ColumnType::IpAddress`
 * @method macAddress() Sets the `$type` to `ColumnType::MacAddress`
 * @method geometry() Sets the `$type` to `ColumnType::Geometry`
 * @method point() Sets the `$type` to `ColumnType::Point`
 * @method vector() Sets the `$type` to `ColumnType::Vector`
 */
class Column{
    public ColumnType $type;
    public bool $nullable = false;

    public function __construct(public string $name){}


    /**
     * Set the column type
     */
    public function __call($property, $args): static{
        $this->type = ColumnType::tryFrom(strtoupper($property));
        return $this;
    }
}