<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cloth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClothController extends Controller
{
    public function get_all_cloth(Request $request)
    {
        $tailors = Cloth::get();
        return response()->json([
            'data' => $tailors
        ]);
    }

    public function create_new_cloth(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->type == 'Admin') {
            $object_cloth = array();
            if (isset($request->cloth_name)) {
                $object_cloth['cloth_name'] = $request->cloth_name;
            }
            if (isset($request->price)) {
                $object_cloth['price'] = $request->price;
            }
            if (isset($request->category_name)) {
                $object_cloth['category_name'] = $request->category_name;
            }
            if (isset($request->status)) {
                $object_cloth['status'] = $request->status;
            }
            if (isset($request->description)) {
                $object_cloth['description'] = $request->description;
            }
            if (isset($request->image)) {
                $object_cloth['image'] = $request->image;
            }
            $cloth = Cloth::create($object_cloth);
            return response()->json([
                'data' => $cloth
            ]);
        } else {
            return response()->json([
                'data' => false
            ]);
        }
    }
}
