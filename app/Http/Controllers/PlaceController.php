<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceCreateRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function place($place){
        $place = Place::findOrFail($place);
        return response()->json(['place'=>$place]);
    }
    public function placesHome()
    {
        return ["places"=>Place::all()];
    }
}
