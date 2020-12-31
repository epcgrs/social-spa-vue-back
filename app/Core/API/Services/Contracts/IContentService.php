<?php

namespace App\Core\API\Services\Contracts;

use App\Core\Entities\Content;

interface IContentService
{
    public function byId(int $id): ?Content;
    public function save(array $data): ?Content;
    public function toggleLike(int $contentId): bool;
}
