<?php
namespace Probe\Support\Contracts;


/**
 * A warehouse for all of your services stored neatly along with their setup logic!
 */
abstract class ServiceProvider{
    
    /**
     * An array of Factories that return a Bootstrapped Service
     * @var array
     */
    protected $services = [];

    /**
     * Custom commands that will be managed by the Application Core / Kernel
     * @var array
     */
    public array $commands = [];

    /**
     * An array of bootstrapped Services
     * @var array
     */
    public $instances = [];

    abstract public function register(): void;

    /**
     * @param class-string<Service> $serviceClass
     * @param \Closure $factory Must return an instance of `Probe\Support\Contracts\Service`. Examples: https://focalphp.com/docs/components/service-provider/#factory
     */
    public function bind(string $serviceClass, \Closure $factory): void{
        if (!is_subclass_of(object_or_class: $serviceClass, class: Service::class)){
            throw new \InvalidArgumentException("{$serviceClass} must extend " . Service::class);
        }
        $this->services[$serviceClass] = $factory;
    }

    public function addCommand(string $command, \Closure $logic): void{
        if (isset($this->commands[$command])){
            throw new \InvalidArgumentException("Cannot overwrite command {$command}");
        }
        $this->commands[$command] = $logic;
    }
    


    public function spinUp(string $serviceName): Service{
        if (!isset($this->services[$serviceName])){
            throw new \InvalidArgumentException("Service {$serviceName} is not binded to " . self::class);
        }
        // Cache it!!!!!
        $this->instances[$serviceName] = $this->services[$serviceName]($this);
        return $this->instances[$serviceName];
    }
    public function make(string $service): Service{
        return $this->spinUp(serviceName: $service);
    }
    public function bootService(string $serviceName): Service{
        return $this->spinUp(serviceName: $serviceName);
    }
    public function booooooooooooooooooooot(string $service): Service{
        return $this->spinUp(serviceName: $service);
    }
    public function build(string $service): Service{
        return $this->spinUp(serviceName: $service);
    }
}