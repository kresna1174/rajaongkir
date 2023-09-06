<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class FetchController extends Controller
{
    public function provinces()
    {
        $model = Province::when(request()->filled('id'), function($query) {
            $query->where('province_id', request('id'));
        });
        if (request('id')) {
            $model = $model->first();
        } else {
            $model = $model->get();
        }
        if ($model) {
            return response()->json([
                'success' => true,
                'data' => $model
            ], 200);
        }
        return response()->json([
            'success' => false,
            'error' => 'data not found'
        ], 404);
    }

    public function cities()
    {
        $model = City::with('province')->when(request()->filled('id'), function($query) {
            $query->where('city_id', request('id'));
        });
        if (request('id')) {
            $model = $model->first();
        } else {
            $model = $model->get();
        }
        if ($model) {
            return response()->json([
                'success' => true,
                'data' => $model
            ], 200);
        }
        return response()->json([
            'success' => false,
            'error' => 'data not found'
        ], 404);
    }
}
