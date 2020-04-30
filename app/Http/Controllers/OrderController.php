<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

use App\Helpers\ResponseAPI;

class OrderController extends Controller
{
    public function post(Request $request)
    {
        $order = new Order;
        $order->fill($request->all());
        
        return ResponseAPI::success('Data saved',
                                   ['data' => $order->save()]);
    }
}
