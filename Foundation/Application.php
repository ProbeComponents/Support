<?php
namespace Probe\Foundation;

use Probe\Console\Commands\HelpCommand;
use Probe\Foundation\Http\Controller;
use Probe\Foundation\Http\ServiceProvider;
use Probe\Support\Contracts\PathRegistry;


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
     * An registry that holds all of the paths to resources
     * @return class-string<PathRegistry>
     */
    abstract public static function pathRegistry(): string;


    /**
     * Get the registered Base path
     * @return string
     */
    public function basePath(): string{
        return static::pathRegistry()::basePath();
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
     * @return void
     */
    private function internalCommands(): void{
        $this->addCommand(commandClass: ServiceProvider::class);
        $this->addCommand(commandClass: Controller::class);
        $this->addCommand(commandClass: HelpCommand::class);
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
     * @param class-string<\Probe\Console\Command> $commandClass
     * @throws \InvalidArgumentException If the `$command` is already binded.
     * @return void
     */
    final public function addCommand(string $commandClass): void{
        if (!is_subclass_of(object_or_class: $commandClass, class: \Probe\Console\Command::class)){
            throw new \InvalidArgumentException("{$commandClass} needs to extend " . \Probe\Console\Command::class);
        }

        $command = $commandClass::command();
        if (isset($this->commands[$command])){
            throw new \InvalidArgumentException("Cannot overwrite command {$command}");
        }
        $this->commands[$command] = $commandClass;
    }

    final public function handleCommand(string $command): void{
        if(!key_exists($command, $this->commands)){
            echo "{$command} is not a valid command binded to the Application Kernel!\n\n";
            $this->listCommands();
            return;
        }
        
        $commandClass = $this->commands[$command];
        $commandClass::executeCommand();
    }

    public function listCommands(): void{
        echo "Here is a list of all of the available commands:\n\n";
        foreach($this->commands as $command => $class){
            echo "{$command}\n";
        }
    }
}