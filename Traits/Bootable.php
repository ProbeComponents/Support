<?php
namespace Probe\Support\Traits;


trait Bootable{
    public function __construct(){
        $this->boot();
    }
    /**
     * The logic that will be ran within the constructor
     * @return void
     */
    abstract protected function boot(): void;
}