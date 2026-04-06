<?php
namespace Probe\Database\Ardent\Migrations\Enums;


enum ColumnType
{
    // Numeric
    case Integer;
    case BigInteger;
    case TinyInteger;
    case SmallInteger;
    case MediumInteger;
    case Decimal;
    case Float;
    case Double;
    case Boolean;

    // Strings & Text
    case String;
    case Char;
    case Text;
    case MediumText;
    case LongText;
    case TinyText;

    // Date & Time
    case Date;
    case DateTime;
    case Timestamp;
    case Time;
    case Year;

    // Binary & Objects
    case Binary;
    case Blob;
    case Json;
    case Uuid;
    case Ulid;

    // Specialized
    case Enum;
    case Set;
    case IpAddress;
    case MacAddress;
    case Geometry;
    case Point;
    case Vector;
}