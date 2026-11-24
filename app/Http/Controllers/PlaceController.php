<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceCreateRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function place($place)
    {
        $place = Place::findOrFail($place);
        $comments = Comment::where("place_id", $place->id)->with('user')->get();
        // $user_order = Order::where("place_id",$place->id)->where('status', 'done')->get();
        return response()->json(['place' => $place, 'comments' => $comments]);
    }
    public function placesHome()
    {
        return ["places" => Place::all()];
    }



    public function placeedit(PlaceUpdateRequest $request, Place $place)
    {
        $place->name = $request->name;
        $place->desc = $request->desc;
        if ($request->has("photo")) {
            $path = Storage::disk("public")->putFile('/photos', $request->file("photo"));
            $place->photo = $path;
        }
        $place->save();
        return response()->json(["id" => $place->id]);
    }
    public function placeadd(PlaceCreateRequest $request)
    {
        $place = new Place();
        $place->name = $request->name;
        $place->desc = $request->desc;
        $path = Storage::disk("public")->putFile('/photos', $request->file("photo"));
        $place->photo = $path;
        $place->save();
        return response()->json(["id" => $place->id]);
    }
    public function placedelete(Place $place)
    {
        $place->delete();
        return response()->json(["message"=>"ok"]);
    }
}
