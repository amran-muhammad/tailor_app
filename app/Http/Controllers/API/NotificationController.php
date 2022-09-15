<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create_new_notification(Request $request)
    {
        $data = $request->all();
        $notification = Notification::create($data);
        return response()->json([
            'data' => $notification,
            'success' => true
        ]);
    }
    public function delete_notification(Request $request)
    {
        $data = $request->all();
        $notification = Notification::where('id',$data['id'])->delete();
        return response()->json([
            'data' => $notification,
            'success' => true
        ]);
    }
    public function update_notification(Request $request)
    {
        $data = $request->all();
        $notification = Notification::where('id',$data['id'])->update(['is_seen','yes']);
        return response()->json([
            'data' => $notification,
            'success' => true
        ]);
    }
    public function get_single_notification(Request $request)
    {
        $notification = Notification::where('id',$request->id)->first();
        return response()->json([
            'data' => $notification,
            'success' => true
        ]);
    }
    public function get_all_notification(Request $request)
    {
        $data = $request->all();
        if($request->type=='Customer'){
            $notification = Notification::where('customer_id',$data['customer_id'])->where('is_seen','no')->get();
        }
        else if($request->type=='Tailor'){
            $notification = Notification::where('tailor_id',$data['tailor_id'])->where('is_seen','no')->get();
        }
        else if($request->type=='Admin'){
            $notification = Notification::with('customer','tailor')->get();
        }
        return response()->json([
            'data' => $notification,
            'success' => true
        ]);
    }
}
