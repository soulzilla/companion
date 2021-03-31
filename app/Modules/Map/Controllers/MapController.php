<?php

namespace App\Modules\Map\Controllers;

use App\Models\Map;
use App\Modules\Map\Requests\MapRequest;
use App\Modules\Map\Resources\MapResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MapController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Map::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Map::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return MapResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param MapRequest $request
     * @return JsonResponse
     */
    public function store(MapRequest $request)
    {
        $data = $request->validated();
        $map = new Map($data);
        $map->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Map $map
     * @return MapResource
     */
    public function show(Map $map)
    {
        return new MapResource($map);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MapRequest $request
     * @param Map $map
     * @return JsonResponse
     */
    public function update(MapRequest $request, Map $map)
    {
        $data = $request->validated();
        $map->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Map $map
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Map $map)
    {
        $map->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
