<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\Union;

class LocationController extends Controller
{
    public function getDivisions(Request $request)
    {
        return $this->fetchLocations(Division::query(), $request, 'Divisions');
    }

    public function getDistricts(Request $request)
    {
        return $this->fetchLocations(District::query(), $request, 'Districts');
    }

    public function getUpazilas(Request $request)
    {
        return $this->fetchLocations(Upazila::query(), $request, 'Upazilas');
    }

    public function getUnions(Request $request)
    {
        return $this->fetchLocations(Union::query(), $request, 'Unions');
    }

    private function fetchLocations($query, Request $request, $name)
    {
        $query = $query->filter($request);
        $data = $request->boolean('all', false) ? $query->get(['id', 'name']) : $query->paginate();
        
        return response()->json([
            'status' => true,
            'message' => "$name retrieved successfully",
            'data' => $data,
        ]);
    }
}
