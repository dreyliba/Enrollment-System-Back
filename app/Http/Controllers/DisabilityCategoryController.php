<?php

namespace App\Http\Controllers;

use App\DisabilityCategory;
use App\Http\Resources\DisabilityCategoryResource;
use Exception;
use Illuminate\Http\Request;

class DisabilityCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = DisabilityCategory::query();

        if (!empty($request->search)) {
            $query->where('name', $request->search);
        };

        return DisabilityCategoryResource::collection($query->get());
    }

    public function store(Request $request)
    {
        try {
            return new DisabilityCategoryResource(DisabilityCategory::create($request->all()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, DisabilityCategory $disabilityCategory)
    {
        try {
            return new DisabilityCategoryResource(tap($disabilityCategory)->update($request->all()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy(DisabilityCategory $disabilityCategory)
    {
        try {
            return response()->json([
                'data' => $disabilityCategory,
                'deleted' => $disabilityCategory->delete(),
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
