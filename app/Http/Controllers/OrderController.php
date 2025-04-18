<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    
    public function allorders()
    {
        $allorders = DB::table('orders')->orderBy('created_at', 'desc')->get();
        
        return view('Order.allorders',compact('allorders'))->with('i');

    }
    
    public function allorderdetails($id)
    {
        $order_id = DB::table('orders')->where('id',$id)->latest()->first();
        $allorder_details = DB::table('orderdetails')->where('order_id',$id)->latest()->get();
        
        $allorderdetails = [];
        
        foreach($allorder_details as $all)
        {
            $dat['id'] = $all->id;
            
            $product_data = DB::table('products')->where('id',$all->product_id)->latest()->first();
            $seller_data = DB::table('sellers')->where('seller_id',$product_data->seller_id)->latest()->first();
            $brand_data = DB::table('brands')->where('id',$product_data->brand_id)->latest()->first();
            $color_data = DB::table('colors')->where('hex_code',$product_data->color_name)->latest()->first();
            
            $images = json_decode($product_data->images, true); 
            
            $dat['images'] = !empty($images) ? $images[0] : null;            
            $dat['product_name'] = $product_data->product_name;
            $dat['sold_by'] = $seller_data->company_name;
            $dat['brand_name'] = $brand_data->brand_name;
            $dat['color'] = $color_data->color_name;
            $dat['size'] = $product_data->size_name;
            $dat['price'] = $all->price;
            $dat['quantity'] = $all->quantity;
            $dat['delivery_status'] = $all->delivery_status;
            $dat['sku'] = $product_data->sku;
            $dat['discount'] = $product_data->maximum_retail_price - $all->price;
            $dat['mrp'] = $product_data->maximum_retail_price;
            $dat['bsp'] = $product_data->bank_settlement_price;

            $allorderdetails[] = $dat;
        }
        
        return view('Order.allorderdetails',compact('allorderdetails','order_id'))->with('i');

    }
    
    public function updateDeliveryStatus(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->delivery_status;
    
        $update = DB::table('orderdetails')
                    ->where('id', $orderId)
                    ->update(['delivery_status' => $status]);
    
        if ($update) {
            return response()->json(['success' => true, 'message' => 'Delivery status updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update delivery status.']);
        }
    }
    public function neworders()
    {
        return view('Order.neworders');
    }
}
