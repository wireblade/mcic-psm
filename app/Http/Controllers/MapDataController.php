<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\JsonResponse;

class MapDataController extends Controller
{
    public function projects(): JsonResponse
    {
        $projects = Project::select('id', 'name', 'description', 'latitude', 'longitude')
            ->where('status', 0)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $projects->map(function ($p) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [(float)$p->longitude, (float)$p->latitude],
                    ],
                    'properties' => [
                        'id' => $p->id,
                        'name' => $p->name,
                        'description' => $p->description,
                    ],
                ];
            })->values(),
        ];

        return response()->json($geojson);
    }

    public function finishedProject(): JsonResponse
    {
        $projects = Project::select('id', 'name', 'description', 'latitude', 'longitude')
            ->where('status', 1)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $projects->map(function ($p) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [(float)$p->longitude, (float)$p->latitude],
                    ],
                    'properties' => [
                        'id' => $p->id,
                        'name' => $p->name,
                        'description' => $p->description,
                    ],
                ];
            })->values(),
        ];

        return response()->json($geojson);
    }
}
