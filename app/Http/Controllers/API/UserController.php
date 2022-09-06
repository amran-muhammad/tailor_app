<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->status == 'Pending') {
                $success = false;
                $message = "You are not approved yet by admin!";
            } else {
                if (Auth::attempt($credentials)) {
                    $success = true;
                    $message = "User login successfully";
                } else {
                    $success = false;
                    $message = "Unautorised";
                }
            }
        } else {
            $success = false;
            $message = "Unautorised";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }
    public function user_login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            $success = true;
            $message = "User login successfully";
        } else {
            $success = false;
            $message = "Unautorised";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }


   


    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = "Logout successfully";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];
        
        return response()->json($response);
    }
    public function get_all_tailor(Request $request)
    {
        $tailors = User::where('type', 'Tailor')->get();
        return response()->json([
            'data' => $tailors,
            'success' => true,
        ]);
    }
    public function get_all_dashboard_teacher(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $tailors = User::where('type', 'Tailor')->where('status', 'Approved')->get();
            return response()->json([
                'data' => $tailors
            ]);
        } else {
            return response()->json([
                'data' => false
            ]);
        }
    }

    public function get_all_customer(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->type == 'Admin') {
            $customers = User::where('type', 'Customer')->get();
            return response()->json([
                'data' => $customers
            ]);
        } else {
            return response()->json([
                'data' => false
            ]);
        }
    }
    public function create_new_customer(Request $request)
    {
        $customer = new User();
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->type = 'Customer';
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->save();
        return response()->json([
            'data' => $customer,
            'success' => true
        ]);
    }
    public function create_new_tailor(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->type == 'Admin') {
            $tailor = new User();
            $tailor->fname = $request->fname;
            $tailor->lname = $request->lname;
            $tailor->email = $request->email;
            $tailor->password = Hash::make($request->password);
            $tailor->type = 'Tailor';
            $tailor->mobile = $request->mobile;
            $tailor->status = $request->status;
            $tailor->address = $request->address;
            $tailor->save();
            return response()->json([
                'data' => $tailor,
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => false,
                'success' => false
            ]);
        }
    }
    public function update_user(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user = User::where('id', $request->id)->first();
            $object_user = array();
            if (isset($request->fname)) {
                $object_user['fname'] = $request->fname;
            }
            if (isset($request->lname)) {
                $object_user['lname'] = $request->lname;
            }
            if (isset($request->email)) {
                $object_user['email'] = $request->email;
            }
            if (isset($request->status)) {
                $object_user['status'] = $request->status;
            }
            if (isset($request->mobile)) {
                $object_user['mobile'] = $request->mobile;
            }
            if (isset($request->type)) {
                $object_user['type'] = $request->type;
            }
            if (isset($request->address)) {
                $object_user['address'] = $request->address;
            }
            $user->update($object_user);
            return response()->json([
                'data' => $user,
                'success' => true
            ]);
        
        } else {
            return response()->json([
                'data' => false,
                'success' => false
            ]);
        }
    }

    public function find_a_user(Request $request)
    {
        $data = array();
        if ($request->type == 'Customer') {
            $data = User::where(function ($query) use ($request) {
                $query->where('type', '=', $request->type);
            })->where(function ($query) use ($request) {
                $query->where('fname', '=', $request->search)
                    ->orWhere('lname', '=', $request->search)
                    ->orWhere('mobile', '=', $request->search)
                    ->orWhere('email', '=', $request->search);
            })->get();
        } else if ($request->type == 'Tailor') {
            $data = User::where(function ($query) use ($request) {
                $query->where('type', '=', $request->type);
            })->where(function ($query) use ($request) {
                $query->where('fname', '=', $request->search)
                    ->orWhere('lname', '=', $request->search)
                    ->orWhere('email', '=', $request->search)
                    ->orWhere('mobile', '=', $request->search);
            })->get();
        }

        return response()->json([
            'data' => $data,
            'success' => true
        ]);
        
    }

    public function delete_user(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->type == 'Admin') {
                User::where('id', $request->id)->delete();
                return response()->json([
                    'data' => true,
                    'success' => true
                ]);
        } else {
            return response()->json([
                'data' => false,
                'success' => false
            ]);
        }
    }
}
