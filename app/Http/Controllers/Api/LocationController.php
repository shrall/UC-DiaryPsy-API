<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function province()
    {
        $provinces = Province::all();
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $provinces
        ];
        return SuccessResource::make($return);
    }
    public function city()
    {
        $cities = Regency::all();
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $cities
        ];
        return SuccessResource::make($return);
    }
    public function district()
    {
        $districts = District::all();
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $districts
        ];
        return SuccessResource::make($return);
    }
    public function village()
    {
        $villages = Village::all();
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $villages
        ];
        return SuccessResource::make($return);
    }
}
