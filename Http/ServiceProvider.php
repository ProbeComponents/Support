<?php
namespace Probe\Http;


use Probe\Blueprints\Makeable;
use Probe\Contracts\Service;


/**
 * A warehouse for all of your services stored neatly along with their setup logic!
 */
abstract class ServiceProvider extends Makeable{
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


    /** FOR CLI */
    public static function stub(): string{
        return "provider.stub";
    }
    public static function folder(): string{
        return "Providers";
    }
    final public static function suffix(): string{
        return "provider";
    }
    public static function namespace(): string{
        return "App\Http";
    }
    /** END OF CLI */

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
    

    public function boot(string $serviceName): Service{
        if (!isset($this->services[$serviceName])){
            throw new \InvalidArgumentException("Service {$serviceName} is not binded to " . self::class);
        }
        $this->instances[$serviceName] = $this->services[$serviceName]($this);
        return $this->instances[$serviceName];
    }
}