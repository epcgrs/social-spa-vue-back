<?php

namespace App\Core\API\Repositories;

use App\Core\API\Repositories\Contracts\ICommentsRepository;
use App\Core\Entities\Comment;

class CommentRepository implements ICommentsRepository
{
    public function byId(int $key): ?Comment
    {
        return Comment::find($key);
    }

    public function store(array $data): ?Comment
    {
        $entity = new Comment();

        if( ! empty($data[$entity->getKeyName()]))
        {
            $entityFound = Comment::find($data[$entity->getKeyName()]);

            if(!is_null($entityFound))
                $entity = $entityFound;
        }

        return $entity->fill($data)->save() ? $entity : NULL;
    }
}
