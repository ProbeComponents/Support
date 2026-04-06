<?php
namespace Probe\Foundation;

use Probe\Foundation\Http\ServiceProvider;


/**
 * A base Application kernel class with:
 * * Proivder Binding
 * * Custom Command Binding
 */
abstract class Application{

    /**
     * An array of Service providers that extend `Probe\Contracts\ServiceProvider`.
     * @var ServiceProvider[]
     */
    protected array $providers = [];

    /**
     * An array of `\Probe\Console\UserCommand`
     * @var array
     */
    protected array $commands = [];

    /**
     * An array of `\Probe\Console\InternalCommand`
     * @var array
     */
    protected array $internalCommands = [];


    public function __construct(){
        $this->register();
        
        // Only run command/CLI bootstrapping if we are actually in the terminal
        if (php_sapi_name() === 'cli' || php_sapi_name() === 'phpdbg') {
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
     * @param class-string<\Probe\Console\UserCommand> $commandClass
     * @throws \InvalidArgumentException If the `$command` is already binded.
     * @return void
     */
    final public function addCommand(string $commandClass): void{
        if (!is_subclass_of(object_or_class: $commandClass, class: \Probe\Console\UserCommand::class)){
            throw new \InvalidArgumentException("{$commandClass} needs to extend " . \Probe\Console\UserCommand::class);
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