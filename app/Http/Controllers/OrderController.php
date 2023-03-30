<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Student;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('student', 'restaurant')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'menu_item_id' => 'required|exists:menu_items,id',
        ]);

        $order = Order::create([
            'student_id' => $request->student_id,
            'restaurant_id' => $request->restaurant_id,
            'menu_item_id' => $request->menu_item_id,
        ]);

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return response()->json($order->load('student', 'restaurant'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'student_id' => 'sometimes|exists:students,id',
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'menu_item_id' => 'sometimes|exists:menu_items,id',
        ]);

        $order->update($request->only(['student_id', 'restaurant_id', 'menu_item_id']));

        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}

