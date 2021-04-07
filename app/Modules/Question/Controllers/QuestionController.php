<?php

namespace App\Modules\Question\Controllers;

use App\Models\Question;
use App\Modules\Question\Requests\QuestionRequest;
use App\Modules\Question\Resources\QuestionResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuestionController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Question::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Question::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return QuestionResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param QuestionRequest $request
     * @return JsonResponse
     */
    public function store(QuestionRequest $request)
    {
        $data = $request->validated();
        $question = new Question($data);
        $question->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $data = $request->validated();
        $question->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Question $question
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
