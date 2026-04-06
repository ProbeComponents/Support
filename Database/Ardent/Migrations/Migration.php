<?php
require_once "../../../vendor/autoload.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
displayErrors();
// THIS IS A TEST MIGRATION, REMOVE AFTER DEVELOPMENT CONCLUDES
use Probe\Database\Ardent\Migrations\Table;

$table = new Table("Users")->schema(blueprint: function(Table $table): void{
    $table->id("id");
    $table->text(name: "username")->nullable(false);
});

print_r($table->columns);