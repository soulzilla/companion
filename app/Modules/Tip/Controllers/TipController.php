<?php

namespace App\Modules\Tip\Controllers;

use App\Models\Tip;
use App\Modules\Tip\Requests\TipRequest;
use App\Modules\Tip\Resources\TipResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TipController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Tip::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Tip::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return TipResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param TipRequest $request
     * @return JsonResponse
     */
    public function store(TipRequest $request)
    {
        $data = $request->validated();
        $tip = new Tip($data);
        $tip->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Tip $tip
     * @return TipResource
     */
    public function show(Tip $tip)
    {
        return new TipResource($tip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TipRequest $request
     * @param Tip $tip
     * @return JsonResponse
     */
    public function update(TipRequest $request, Tip $tip)
    {
        $data = $request->validated();
        $tip->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Tip $tip
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Tip $tip)
    {
        $tip->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
