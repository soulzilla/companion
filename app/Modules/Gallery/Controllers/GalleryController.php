<?php

namespace App\Modules\Gallery\Controllers;

use App\Models\Gallery;
use App\Modules\Gallery\Requests\GalleryRequest;
use App\Modules\Gallery\Resources\GalleryResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GalleryController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Gallery::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Gallery::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return GalleryResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param GalleryRequest $request
     * @return JsonResponse
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();
        $gallery = new Gallery($data);
        $gallery->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Gallery $gallery
     * @return GalleryResource
     */
    public function show(Gallery $gallery)
    {
        return new GalleryResource($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GalleryRequest $request
     * @param Gallery $gallery
     * @return JsonResponse
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        $gallery->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Gallery $gallery
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
