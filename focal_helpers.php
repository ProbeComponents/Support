<?php
/**
* Helper function to access the App instance
* * You can use this method: `Only in a Focal App`
* @return Probe\Foundation\Application
*/
function app(): \Probe\Foundation\Application{
    return require_once config(key: "bootstrap_path");
}

/**
 * @param string $name
 * @return string|false Returns the file path of a stub or false if it does not exist.
 */
function stub(string $name){
    return match(true){
        app()->doesStubExist($name) => app()->getStubPath($name),
        default => false,
    };
}

/**
 * Returns the currently set value from config/app.php or any other config file in App/config/
 * * Can be run: `Only in a Focal App`
 * @param string $key
 * @param string $config The name of the config you want to fetch from, i.e `app` => `config/app.php`
 * @throws Exception
 * @return string|null
 */
function config(string $key, string $config = "app"): string|null{
    if (!file_exists(app()->basePath() . "/config/{$config}.php")){
        throw new Exception("Config file config/{$config}.php does not exist.");
    }
    $config = require_once app()->basePath() . "/config/{$config}.php";
    return $config[$key] ?? NULL;
}

/**
 * Helper function to include a view file
 * * Can be run: `Only in a Focal App`
 * @param string $view `partials.auth.index` = `views/partials/auth/index`
 * @return void
 */
function view(string $view): void{
    include_once app()->basePath() . "/views/" . str_replace(search: ".", replace: "/", subject: $view) . ".php";
}

/**
 * Get the full path for a file or directory from the `resource` folder
 * * Can be run: `Only in a Focal App`
 * * Get a folder path: `$resource` = `folder/path" OR "/folder/path/` (The prepended slash gets trimmed)
 * * Get a file path: `$resource` = `folder/folder2/file.extension` Returns `app()->basePath() + /resources/folder/folder2/file.extension`
 * @param string $resource
 * @return string
 */
function resource(string $resource): string{
    return app()->basePath() . "/resources/{$resource}";
}

if (isFocalApp() && app()->has("LiveX")){
    function liveX(): \LiveX\LiveX{
        return \LiveX\LiveX::getInstance();
    }
}