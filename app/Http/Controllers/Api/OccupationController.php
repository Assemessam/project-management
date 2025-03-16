<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use App\Services\OccupationFilterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $filter = $request->query('filter');

        $query = Occupation::query()->with(['languages', 'locations', 'categories', 'attributeValues.attribute']);

        if ($filter) {
            $query = app(OccupationFilterService::class)->apply($query, $filter);
        }

        return response()->json($query->paginate(10));
    }
}
