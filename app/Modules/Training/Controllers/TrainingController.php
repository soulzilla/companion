<?php

namespace App\Modules\Training\Controllers;

use App\Models\Training;
use App\Modules\Training\Requests\TrainingRequest;
use App\Modules\Training\Resources\TrainingResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TrainingController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Training::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Training::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return TrainingResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param TrainingRequest $request
     * @return JsonResponse
     */
    public function store(TrainingRequest $request)
    {
        $data = $request->validated();
        $training = new Training($data);
        $training->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Training $training
     * @return TrainingResource
     */
    public function show(Training $training)
    {
        return new TrainingResource($training);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TrainingRequest $request
     * @param Training $training
     * @return JsonResponse
     */
    public function update(TrainingRequest $request, Training $training)
    {
        $data = $request->validated();
        $training->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Training $training
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Training $training)
    {
        $training->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
