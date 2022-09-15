<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;



class OrderController extends Controller
{
    public function create_new_order(Request $request)
    {
        $data = $request->all();
        $order = Order::create($data);
        return response()->json([
            'data' => $order,
            'success' => true
        ]);
    }
    public function delete_order(Request $request)
    {
        $data = $request->all();
        $order = Order::where('id',$data['id'])->delete();
        return response()->json([
            'data' => $order,
            'success' => true
        ]);
    }
    public function get_single_order(Request $request)
    {
        $order = Order::with('customer','tailor','cloth')->where('id',$request->id)->first();
        $images=array();
        $images[0]= $order['cloth']['image'];
        $images[1] = $order['cloth']['image2'];
        $order['cloth']['images'] = $images;
        return response()->json([
            'data' => $order,
            'success' => true
        ]);
    }
    public function get_all_order(Request $request)
    {
        $data = $request->all();
        if($request->type=='Customer'){
            $order = Order::with('customer','tailor','cloth')->where('customer_id',$data['customer_id'])->get();
        }
        else if($request->type=='Tailor'){
            $order = Order::with('customer','tailor','cloth')->where('tailor_id',$data['tailor_id'])->get();
        }
        else if($request->type=='Admin'){
            $order = Order::with('customer','tailor','cloth')->get();
        }
        for($i=0;$i<sizeof(($order));$i++){
            $images=array();
            $images[0]= $order[$i]['cloth']['image'];
            $images[1] = $order[$i]['cloth']['image2'];
            $order[$i]['cloth']['images'] = $images;
        }

        return response()->json([
            'data' => $order,
            'success' => true
        ]);
    }

    public function update_order(Request $request)
    {
        $obj = array();
        if($request->order_status){
            $obj['order_status'] = $request->order_status;
            $notification_data = array();
            if($request->title){
                $notification_data['title']= $request->title;
            }
            if($request->message){
                $notification_data['message']= $request->message;
            }
            $notification_data['status']= $request->order_status;
            $notification_data['tailor_id']= $request->tailor_id;
            $notification_data['customer_id']= $request->customer_id;
            $notification_data['order_id']= $request->id;
            Notification::create($notification_data);
        }
        Order::where('id',$request->id)->update($obj);
        $order = Order::with('customer','tailor','cloth')->where('id',$request->id)->first();
        $images=array();
        $images[0]= $order['cloth']['image'];
        $images[1] = $order['cloth']['image2'];
        $order['cloth']['images'] = $images;
        
        return response()->json([
            'data' => $order,
            'success' => true
        ]);
    }

    public function sort_order(Request $request)
    {
        $data = array();
        if($request->user_type && $request->user_type=='Admin'){
            if($request->order_status){
                $data = Order::with('customer','tailor','cloth')->where('order_status',$request->order_status)->get();
            }else{
                $data = Order::with('customer','tailor','cloth')->orderBy($request->sort,$request->sort_type)->get();
            }
        }
        else if($request->order_status){
            $data = Order::with('customer','tailor','cloth')->where('tailor_id',$request->tailor_id)->where('order_status',$request->order_status)->get();
        }else{
            $data = Order::with('customer','tailor','cloth')->where('tailor_id',$request->tailor_id)->orderBy($request->sort,$request->sort_type)->get();
        }
        
        return response()->json([
            'data' => $data,
            'success' => true
        ]);
    }
}
