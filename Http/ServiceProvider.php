<?php
namespace Probe\Foundation\Http;


use Probe\Contracts\Makeable;
use Probe\Contracts\Service;
use Probe\Support\Traits\HasStub;


/**
 * A warehouse for all of your services stored neatly along with their setup logic!
 */
abstract class ServiceProvider extends Makeable{
    use HasStub;

    /**
     * An array of Factories that return a Bootstrapped Service
     * @var array
     */
    protected $services = [];

    /**
     * An array of bootstrapped Services
     * @var array
     */
    public $instances = [];

    public static function stub(): string{
        return "provider.stub";
    }
    final public static function suffix(): string{
        return "provider";
    }
    final public static function executeCommand(): void{
        //
    }

    /**
     * Define a bootstrap process for the provider, bind any Services required for your application here
     * @return void
     */
    abstract public function register(): void;

    /**
     * @param class-string<Service> $serviceClass
     * @param \Closure $factory Must return an instance of `Probe\Contracts\Service`. Examples: https://focalphp.com/docs/components/service-provider/#factory
     */
    public function bind(string $serviceClass, \Closure $factory): void{
        if (!is_subclass_of(object_or_class: $serviceClass, class: Service::class)){
            throw new \InvalidArgumentException("{$serviceClass} must extend " . Service::class);
        }
        $this->services[$serviceClass] = $factory;
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