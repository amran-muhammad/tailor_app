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
            'data' => $tailors,
            'success' => true
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

    public function update_cloth(Request $request)
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
            $cloth = Cloth::where('id',$request->id)->update($object_cloth);
            $cloth = Cloth::where('id',$request->id)->first();
            return response()->json([
                'data' => $cloth
            ]);
        } else {
            return response()->json([
                'data' => false
            ]);
        }
    }

    public function delete_cloth(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->type == 'Admin') {
            Cloth::where('id', $request->id)->delete();
                return response()->json([
                    'data' => true
                ]);
        } else {
            return response()->json([
                'data' => false
            ]);
        }
    }

    public function find_a_cloth(Request $request)
    {
        $data = array();
        $no_filter = "no";
        
        if (isset($request->search) && isset($request->category_name)) {
            $data = Cloth::where(function ($query) use ($request) {
                $query->where('category_name', '=', $request->category_name);
            })->where(function ($query) use ($request) {
                $query->orWhere('cloth_name', 'regexp', $request->search)
                    ->orWhere('description', 'regexp', $request->search);
            });
        }
        else if (isset($request->category_name) && !isset($request->search)) {
            $data = Cloth::where(function ($query) use ($request) {
                $query->where('category_name', '=', $request->category_name);
            });
        }
       
        else if (isset($request->search)) {
            $data = Cloth::where(function ($query) use ($request) {
                $query->orWhere('cloth_name', 'regexp', $request->search)
                    ->orWhere('description', 'regexp', $request->search);
            });
        }
        else {
            $no_filter = "yes";
            if(isset($request->sort)){
                $data = Cloth::orderBy($request->sort,$request->sort_type)->get();
            }else{
                $data = Cloth::all();
            }
        }

        if($no_filter == "no"){
            if(isset($request->sort)){
                $data = $data->orderBy($request->sort,$request->sort_type);
            }
            $data = $data->get();
        }

        return response()->json([
            'data' => $data,
            'payload' => $request->all()
        ]);
    }
}
