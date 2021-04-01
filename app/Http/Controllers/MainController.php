<?php

namespace App\Http\Controllers;

use App\Enums\AdvantageGroupsEnum;
use App\Enums\AdvantageTypeEnum;
use App\Models\Advantage;
use App\Models\Advertisement;
use App\Models\Gallery;
use App\Models\Map;
use App\Models\Tip;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $this->addVisit($request);

        $maps = Cache::get('maps');
        if (!$maps) {
            $maps = Map::query()
                ->orderBy('weight')
                ->get();

            Cache::add('maps', $maps, 300);
        }

        return response()->json([
            'maps' => $maps,
            'ads' => $this->getAds(),
            'gallery' => $this->getGallery()
        ]);
    }

    public function visits()
    {
        $visitsToday = Visit::query()
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        $visitsTotal = Visit::query()->count();

        return response()->json([
            'today' => $visitsToday,
            'total' => $visitsTotal
        ]);
    }

    public function show(Request $request)
    {
        $this->addVisit($request);

        $canonical = $request->get('canonical');

        /** @var $map Map|null */
        $map = Map::query()
            ->where('canonical', $canonical)
            ->first();

        $grenades = [
            'hes' => [],
            'smokes' => [],
            'flashes' => [],
            'molotoves' => []
        ];
        $boosts = [
            'self' => [],
            'double' => [],
            'team' => []
        ];
        $tricks = [
            'positions' => [],
            'grenades' => []
        ];
        $wallbangs = [];

        if ($map) {
            $advantages = Advantage::query()
                ->where('map_id', $map->id)
                ->when($request->filled('name'), function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->get('name') . '%');
                })
                ->get();

            /** @var Advantage $advantage */
            foreach ($advantages as $advantage) {
                switch ($advantage->type) {
                    case AdvantageTypeEnum::TYPE_GRENADES:
                        if ($advantage->group_type === AdvantageGroupsEnum::GROUP_HE) {
                            $grenades['hes'][] = $advantage;
                        } elseif ($advantage->group_type === AdvantageGroupsEnum::GROUP_SMOKE) {
                            $grenades['smokes'][] = $advantage;
                        } elseif ($advantage->group_type === AdvantageGroupsEnum::GROUP_FLASHBANG) {
                            $grenades['flashes'][] = $advantage;
                        } else {
                            $grenades['molotoves'][] = $advantage;
                        }
                        break;
                    case AdvantageTypeEnum::TYPE_BOOSTS:
                        if ($advantage->group_type === AdvantageGroupsEnum::GROUP_SELF_BOOST) {
                            $boosts['self'][] = $advantage;
                        } elseif ($advantage->group_type === AdvantageGroupsEnum::GROUP_DOUBLE_BOOST) {
                            $boosts['double'][] = $advantage;
                        } else {
                            $boosts['team'][] = $advantage;
                        }
                        break;
                    case AdvantageTypeEnum::TYPE_TIPS_AND_TRICKS:
                        if ($advantage->group_type === AdvantageGroupsEnum::GROUP_POSITION) {
                            $tricks['positions'][] = $advantage;
                        } else {
                            $tricks['grenades'][] = $advantage;
                        }
                        break;
                    case AdvantageTypeEnum::TYPE_WALL_BANGS:
                        $wallbangs[] = $advantage;
                        break;
                }
            }
        }

        return response()->json([
            'map' => $map,
            'ads' => $this->getAds(),
            'tip' => $this->getTip(),
            'grenades' => $grenades,
            'boosts' => $boosts,
            'tricks' => $tricks,
            'wallbangs' => $wallbangs
        ]);
    }

    private function getAds()
    {
        $advertisements = Cache::get('ads');

        if (!$advertisements) {
            $advertisements = Advertisement::query()
                ->where('starts_at', '>', 'NOW()')
                ->where('ends_at', '<', 'NOW()')
                ->limit(4)
                ->get();

            Cache::add('ads', $advertisements, 300);
        }

        return $advertisements;
    }

    private function getGallery()
    {
        $gallery = Cache::get('gallery');
        if (!$gallery) {
            $gallery = Gallery::query()
                ->where('published', true)
                ->limit(3)
                ->orderBy('created_at', 'desc')
                ->get();

            Cache::add('gallery', $gallery, 300);
        }

        return $gallery;
    }

    private function getTip()
    {
        return Tip::query()
            ->inRandomOrder()
            ->first();
    }

    private function addVisit(Request $request)
    {
        $visit = Visit::query()
            ->where('ip_address', $request->ip())
            ->where('fingerprint', $request->fingerprint())
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->first();

        if (!$visit) {
            $visit = new Visit();
            $visit->fingerprint = $request->fingerprint();
            $visit->ip_address = $request->ip();
            $visit->save();
        }
    }
}
