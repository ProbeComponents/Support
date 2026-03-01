<?php
namespace Probe\Support\Contracts;


abstract class Configurable{
    protected static string $configPath = "";

    abstract protected function defaultConfigPath();

    /**
     * Bind the config
     * @param string $path
     * @return void
     */
    abstract public function bindConfig(string $path);
}