<?php

namespace App\Core\API\Services;

use App\Core\API\Repositories\Contracts\IContentRepository;
use App\Core\API\Services\Contracts\IContentService;
use App\Core\Entities\Content;

class ContentService implements IContentService
{
    /* @var IContentRepository */
    protected $contentRepository;

    public function __construct(IContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function byId(int $id): ?Content
    {
        return $this->contentRepository->byId($id);
    }

    public function save(array $data): ?Content
    {
        return $this->contentRepository->save($data);
    }

    public function toggleLike(int $contentId): bool
    {
        return $this->contentRepository->toggleLike($contentId);
    }


}
