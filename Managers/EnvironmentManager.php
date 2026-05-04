<?php
namespace Probe\Managers;

use Dotenv\Dotenv;
use Probe\Patterns\Singleton;


class EnvironmentManager extends Singleton{
    protected ?Dotenv $loader = null;

    /**
     * Load Environment variables
     * @param string $directory The directory where the `.env` file is located
     */
    public function loader(string $directory): Dotenv{
        $this->loader = Dotenv::createImmutable($directory);
        return $this->loader;
    }
}