<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function find(int $id): Model;
    public function all(): Collection;
}
