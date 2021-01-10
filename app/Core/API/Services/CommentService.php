<?php

namespace App\Core\API\Services;

use App\Core\API\Repositories\Contracts\ICommentsRepository;
use App\Core\API\Services\Contracts\ICommentService;
use App\Core\Entities\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService implements ICommentService
{

    /* @var ICommentsRepository */
    protected $commentRepository;

    public function __construct(ICommentsRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function byId(int $key): ?Comment
    {
        return $this->commentRepository->byId($key);
    }

    public function store(array $data): ?Comment
    {
        $data['user_id'] = Auth::id();
        return $this->commentRepository->store($data);
    }

}
