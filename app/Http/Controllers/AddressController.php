<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    }

    public function getDistricts($stateId)
    {
        $districts = District::where('state_id', $stateId)->get();
        return response()->json($districts);
    }
}
