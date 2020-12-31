<?php

namespace App\Http\Controllers\API;

use App\Core\API\Services\Contracts\IContentService;
use App\Core\Entities\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{

    /* @var IContentService */
    protected $contentService;

    public function __construct(IContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function save(array $data): ?Content
    {
        if(isset($data['image'])) {

            if (isset($data['id'])) {
                $content = $this->contentService->byId($data['id']);

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


        return $this->contentService->save($data);

    }

    public function toggleLike(Request $request)
    {
        $contentId = $request->input('content_id');

        if ($this->contentService->toggleLike($contentId)) {
            return json_encode([
                'status' => true,
            ]);
        }

        return json_encode(['status' => false]);
    }
}
