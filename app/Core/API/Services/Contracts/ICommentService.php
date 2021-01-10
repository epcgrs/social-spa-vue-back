<?php

namespace App\Core\API\Services\Contracts;

use App\Core\Entities\Comment;

interface ICommentService
{
    public function byId(int $key): ?Comment;
    public function store(array $data): ?Comment;
}
