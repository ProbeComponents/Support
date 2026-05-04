<?php
namespace Probe\Foundation;

use Probe\Blueprints\PathRegistry;
use Probe\Console\Commands\Blueprints\Command;
use Probe\Console\Commands\Blueprints\CommandWithArgs;
use Probe\Console\Commands\Help;
use Probe\Console\Commands\PublishStubs;
use Probe\Http\Controller;
use Probe\Http\ServiceProvider;
use function Laravel\Prompts\error;


/**
 * A base Application kernel class with:
 * * Proivder Binding
 * * Service Binding
 * * Custom CLI Command Binding
 */
abstract class Application{

    /**
     * An array of Service providers that extend `Probe\Contracts\ServiceProvider`.
     * @var ServiceProvider[]
     */
    protected array $providers = [];

    /**
     * An array of `\Probe\Console\Command`
     * @var array
     */
    protected array $commands = [];


    /**
     * A registry that holds all of the paths to resources
     */
    abstract public function pathRegistry(): PathRegistry;


    /**
     * Get the registered Base path
     * @return string
     */
    public function basePath(): string{
        return $this->pathRegistry()->basePath();
    }

    public function __construct(){
        $this->register();
        
        // Only run command/CLI bootstrapping if we are actually in the terminal
        if (php_sapi_name() === 'cli' || php_sapi_name() === 'phpdbg') {
            $this->internalCommands();
            $this->commands();
            $this->CLI();
        }
    }

    /**
     * Define a bootstrap process for the application, bind any Providers and commands here
     * * For CLI commands, We recommend using the `commands()` hook
     * @return void
     */
    abstract public function register(): void;

    /**
     * Hook thats ran on instantiation to bind commands
     * @return void
     */
    abstract public function commands(): void;

    /**
     * Hook that binds internal commands
     */
    private function internalCommands(): void{
        $this->addCommand(ServiceProvider::class);
        $this->addCommand(Controller::class);
        $this->addCommand(Help::class);
        $this->addCommand(PublishStubs::class);
    }

    /**
     * Bootstrap the App for the CLI, List dependencies that will be used in the CLI
     * @return void
     */
    abstract public function CLI(): void;

    /**
     * @param class-string<ServiceProvider> $providerClass
     */
    final public function bind(string $providerClass): void{
        if (!is_subclass_of(object_or_class: $providerClass, class: ServiceProvider::class)){
            throw new \InvalidArgumentException("{$providerClass} must extend " . ServiceProvider::class);
        }
        $this->providers[] = $providerClass;
    }

    /**
     * Bind a command to the Application Kernel to be used in the CLI.
     * @param class-string<Command|CommandWithArgs> $commandClass
     * @throws \InvalidArgumentException If the `$command` is already binded.
     * @return void
     */
    final public function addCommand(string $commandClass): void{
        // if $commandClass does not extend Command or CommandWithArgs
        if (!classExtends($commandClass, Command::class) && !classExtends($commandClass, CommandWithArgs::class)){
            throw new \InvalidArgumentException("{$commandClass} needs to extend " . Command::class);
        }

        $command = $commandClass::command();
        if (isset($this->commands[$command])){
            throw new \InvalidArgumentException("Cannot overwrite command {$command}");
        }
        $this->commands[$command] = $commandClass;
    }

    final public function handleCommand(string $command, array $cliArgs): void{
        if(!key_exists($command, $this->commands)){
            echo "{$command} is not a valid command binded to the Application Kernel!\n\n";
            $this->listCommands();
            return;
        }
        
        $commandClass = $this->commands[$command];

        match(true){
            classExtends($commandClass, Command::class) => $commandClass::executeCommand(),
            classExtends($commandClass, CommandWithArgs::class) => $commandClass::executeCommand(...$cliArgs),
            default => error("Invalid Command: {$commandClass} - It does not extend any of the required base classes!"),
        };
    }

    public function listCommands(): void{
        echo "Here is a list of all of the available commands:\n\n";
        foreach($this->commands as $command => $class){
            echo "{$command}\n";
        }
    }
}