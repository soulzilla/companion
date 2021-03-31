<?php

namespace App\Modules\Advantage\Controllers;

use App\Models\Advantage;
use App\Modules\Advantage\Requests\AdvantageRequest;
use App\Modules\Advantage\Resources\AdvantageResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdvantageController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Advantage::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Advantage::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return AdvantageResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param AdvantageRequest $request
     * @return JsonResponse
     */
    public function store(AdvantageRequest $request)
    {
        $data = $request->validated();
        $advantage = new Advantage($data);
        $advantage->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Advantage $advantage
     * @return AdvantageResource
     */
    public function show(Advantage $advantage)
    {
        return new AdvantageResource($advantage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdvantageRequest $request
     * @param Advantage $advantage
     * @return JsonResponse
     */
    public function update(AdvantageRequest $request, Advantage $advantage)
    {
        $data = $request->validated();
        $advantage->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Advantage $advantage
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Advantage $advantage)
    {
        $advantage->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
