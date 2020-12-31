<?php

namespace App\Core\API\Repositories;

use App\Core\API\Repositories\Contracts\IContentRepository;
use App\Core\Entities\Content;
use Illuminate\Support\Facades\Auth;

class ContentRepository implements IContentRepository
{
    public function byId(int $id): ?Content
    {
        return Content::find($id);
    }

    public function save(array $data): ?Content
    {
        $entity = new Content();

        if( ! empty($data[$entity->getKeyName()]))
        {
            $entityFound = Content::find($data[$entity->getKeyName()]);

            if(!is_null($entityFound))
                $entity = $entityFound;
        }

        return $entity->fill($data)->save() ? $entity : NULL;
    }

    public function toggleLike(int $contentId): bool
    {
        return Auth::user()->likes()->toggle($contentId);
    }

}
