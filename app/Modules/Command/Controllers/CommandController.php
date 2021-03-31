<?php

namespace App\Modules\Command\Controllers;

use App\Models\Command;
use App\Modules\Command\Requests\CommandRequest;
use App\Modules\Command\Resources\CommandResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommandController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Command::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Command::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return CommandResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param CommandRequest $request
     * @return JsonResponse
     */
    public function store(CommandRequest $request)
    {
        $data = $request->validated();
        $command = new Command($data);
        $command->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Command $command
     * @return CommandResource
     */
    public function show(Command $command)
    {
        return new CommandResource($command);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommandRequest $request
     * @param Command $command
     * @return JsonResponse
     */
    public function update(CommandRequest $request, Command $command)
    {
        $data = $request->validated();
        $command->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Command $command
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Command $command)
    {
        $command->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
