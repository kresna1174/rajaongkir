<?php

namespace App\Http\Controllers;

use App\Services\FetchService;

class FetchController extends Controller
{

    protected $fetchService;

    public function __construct(FetchService $fetchService)
    {
        $this->fetchService = $fetchService;
    }

    public function provinces()
    {
        $result = $this->fetchService->getProvince()->when(request()->filled('id'), function($query) {
            $query->where('province_id', request('id'));
        })->when(request()->filled('search'), function($query) {
            $query->where('province', 'LIKE', '%'.request('search').'%');
        });
        if (request('id')) {
            $result = $result->first();
        } else {
            $result = $result->get();
        }
        if ($result) {
            return response()->json([
                'success' => true,
                'data' => $result
            ], 200);
        }
        return response()->json([
            'success' => false,
            'error' => 'data not found'
        ], 404);
    }

    public function cities()
    {
        $result = $this->fetchService->getCity()->with('province')->when(request()->filled('id'), function($query) {
            $query->where('city_id', request('id'));
        })->when(request()->filled('search'), function($query) {
            $query->where('city_name', 'LIKE', '%'.request('search').'%')
                ->orWhereHas('province', function($provinceQuery) {
                    $provinceQuery->where('province', 'LIKE', '%'.request('search').'%');
                });
        });
        if (request('id')) {
            $result = $result->first();
        } else {
            $result = $result->get();
        }
        if ($result) {
            return response()->json([
                'success' => true,
                'data' => $result
            ], 200);
        }
        return response()->json([
            'success' => false,
            'error' => 'data not found'
        ], 404);
    }
}
