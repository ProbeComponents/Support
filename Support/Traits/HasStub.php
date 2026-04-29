<?php
namespace Probe\Support\Traits;


trait HasStub{
    /**
     * Return the stub name.
     * @return void
     */
    abstract static public function stub(): string;
}