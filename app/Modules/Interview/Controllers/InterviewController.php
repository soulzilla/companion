<?php

namespace App\Modules\Interview\Controllers;

use App\Models\Interview;
use App\Modules\Interview\Requests\InterviewRequest;
use App\Modules\Interview\Resources\InterviewResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InterviewController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Interview::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Interview::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return InterviewResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param InterviewRequest $request
     * @return JsonResponse
     */
    public function store(InterviewRequest $request)
    {
        $data = $request->validated();
        $interview = new Interview($data);
        $interview->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Interview $interview
     * @return InterviewResource
     */
    public function show(Interview $interview)
    {
        return new InterviewResource($interview);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InterviewRequest $request
     * @param Interview $interview
     * @return JsonResponse
     */
    public function update(InterviewRequest $request, Interview $interview)
    {
        $data = $request->validated();
        $interview->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Interview $interview
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Interview $interview)
    {
        $interview->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
