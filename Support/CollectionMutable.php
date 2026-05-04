<?php
namespace Probe\Support;


/**
 * A Mutable Collection of items
 * * Immutable Alternative: `Probe\Support\Collection`
 */
class CollectionMutable extends Collection{
    public function append(mixed $item): static{
        $this->items[] = $item;
        return $this;
    }

    public function map(callable $callable): static{
        $this->items = array_map(callback: $callable, array: $this->items);
        return $this;
    }
}