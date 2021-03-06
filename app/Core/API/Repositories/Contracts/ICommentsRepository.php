<?php

namespace App\Core\API\Repositories\Contracts;

use App\Core\Entities\Comment;

interface ICommentsRepository
{
    public function byId(int $key): ?Comment;
    public function store(array $data): ?Comment;
}
