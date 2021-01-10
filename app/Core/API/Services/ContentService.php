<?php

namespace App\Core\API\Services;

use App\Core\API\Repositories\Contracts\IContentRepository;
use App\Core\API\Services\Contracts\IContentService;
use App\Core\Entities\Content;
use App\Core\Entities\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        if(isset($data['image'])) {

            if (isset($data['id'])) {
                $content = $this->contentRepository->byId($data['id']);

                if ($content && $content->image != null) {
                    Storage::disk('contents')->delete($content->getAttributes()['image']);
                }
            }

            $imageBase64 = $data['image'];
            @list($type, $file_data) = explode(';', $imageBase64);
            @list(, $file_data) = explode(',', $file_data);

            $imageName = Str::random(5) . time() .'.'.'png';

            Storage::disk('contents')->put($imageName, base64_decode($file_data));

            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        if($content = $this->contentRepository->save($data)) {
            return $this->contentRepository->byId($content->id);
        }

        return NULL;
    }

    public function toggleLike(int $contentId): ?int
    {
        return $this->contentRepository->toggleLike($contentId);
    }

    public function listPostsByFriends(): LengthAwarePaginator
    {
        return $this->contentRepository->listPostsByFriends(Auth::id());
    }

    public function listUserPosts(int $userId): LengthAwarePaginator
    {

        return $this->contentRepository->listUserPosts($userId);
    }

    public function getAuthor(int $key): User
    {
        return $this->contentRepository->getAuthor($key);
    }

}
