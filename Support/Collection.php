<?php
namespace Probe\Support;

use Probe\Contracts\Collection as Contract;

/**
 * Base Collection class, An Immutable Collection of items
 * * Mutable Alternative: `Probe\Support\CollectionMutable`
 */
class Collection implements Contract{

    /**
     * @param array $items The items in the collection
     */
    public function __construct(protected array $items = []){}

    public function append(mixed $item): static{
        $items = $this->items;
        $items[] = $item;
        return new static($items);
    }

    public function map(callable $callable): static{
        $items = array_map(callback: $callable, array: $this->items);
        return new static($items);
    }
    
    public function size(): int{
        return count($this->items);
    }
}