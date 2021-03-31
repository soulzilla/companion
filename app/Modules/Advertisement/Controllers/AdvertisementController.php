<?php

namespace App\Modules\Advertisement\Controllers;

use App\Models\Advertisement;
use App\Modules\Advertisement\Requests\AdvertisementRequest;
use App\Modules\Advertisement\Resources\AdvertisementResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdvertisementController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Advertisement::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Advertisement::COLUMN_NAME, 'like', '%' . $request->search . '%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return AdvertisementResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param AdvertisementRequest $request
     * @return JsonResponse
     */
    public function store(AdvertisementRequest $request)
    {
        $data = $request->validated();
        $advertisement = new Advertisement($data);
        $advertisement->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Advertisement $advertisement
     * @return AdvertisementResource
     */
    public function show(Advertisement $advertisement)
    {
        return new AdvertisementResource($advertisement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdvertisementRequest $request
     * @param Advertisement $advertisement
     * @return JsonResponse
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $data = $request->validated();
        $advertisement->fill($data)->save();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated'
        ]);
    }

    /**
     * @param Advertisement $advertisement
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted'
        ]);
    }

}
