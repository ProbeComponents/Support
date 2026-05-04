<?php
namespace Probe\Database\Ardent\Concerns;

use Probe\Support\Collection;


trait WithPagination{
    abstract protected int $itemsPerPage;
    protected Collection $pages = [];

    final protected function paginate(Collection $data): void{}
}