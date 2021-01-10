<?php

namespace App\Http\Controllers\API;

use App\Core\API\Services\Contracts\ICommentService;
use App\Core\API\Services\Contracts\IContentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    /* @var IContentService */
    protected $contentService;

    /* @var ICommentService */
    protected $commentService;

    public function __construct(IContentService $contentService, ICommentService $commentService)
    {
        $this->contentService = $contentService;
        $this->commentService = $commentService;
    }

    public function save(Request $request)
    {
        $data = $request->all();

        if ($content = $this->contentService->save($data)) {
            return response()->json([
                'status' => true,
                'content' => $content
            ], 200);
        }
        return response()->json(['status', false], 400);

    }

    public function toggleLike(Request $request)
    {
        $contentId = $request->input('content_id');
        $countLikes = $this->contentService->toggleLike($contentId);

        if (!is_null($countLikes)) {
            return response()->json([
                'status' => true,
                'count_likes' => $countLikes,
            ], 200);
        }

        return response()->json(['status' => false], 400);
    }

    public function listByFriends()
    {
        $contents = $this->contentService->listPostsByFriends();
        return response()->json($contents);
    }

    public function listByUser($id)
    {
        $contents = $this->contentService->listUserPosts($id);
        $user = $this->contentService->getAuthor($id);
        return response()->json(['contents' => $contents, 'user_page' => $user]);
    }

    public function comment(Request $request) {
        if($comment = $this->commentService->store($request->all())) {
            return response()->json([
                'status' => true,
                'comment' => $comment,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
