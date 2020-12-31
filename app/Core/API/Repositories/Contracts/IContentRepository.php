<?php

namespace App\Core\API\Repositories\Contracts;

use App\Core\Entities\Content;

interface IContentRepository
{
    public function byId(int $id): ?Content;
    public function save(array $data): ?Content;
    public function toggleLike(int $contentId): bool;
}
