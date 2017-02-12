<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Visit;
use App\Menu;

class OrderController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/orders",
     *   summary="Get all orders",
     *   operationId="GetAllOrders",
     *   tags={"Orders"},
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }


    /**
     * @SWG\Post(
     *   path="/orders",
     *   summary="Save an order",
     *   operationId="SaveOrder",
     *   tags={"Orders"},
     *   @SWG\Parameter(
     *     name="special_request",
     *     in="formData",
     *     description="message context",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="option_selected",
     *     in="formData",
     *     description="option description",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="visit_id",
     *     in="formData",
     *     description="Visit Id",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Parameter(
     *     name="menu_id",
     *     in="formData",
     *     description="Menu Id",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visit = Visit::findOrFail($request->visit_id);
        $menu = Menu::findOrFail($request->menu_id);
        $order = new Order;

        $order->special_request = $request->special_request;
        $order->option_selected = $request->option_selected;
        $order->visit()->associate($visit);
        $order->menu()->associate($menu);

        $order->save();

        return $order;
    }

    /**
     * @SWG\Get(
     *   path="/orders/{orderId}",
     *   summary="Get an Order",
     *   operationId="GetOrder",
     *   tags={"Orders"},
     *   @SWG\Parameter(
     *     name="orderId",
     *     in="path",
     *     description="Order id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     *
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::findOrFail($id);
    }

    /**
     * @SWG\Delete(
     *   path="/orders/{orderId}",
     *   summary="Delete an order",
     *   operationId="DeleteOrder",
     *   tags={"Orders"},
     *   @SWG\Parameter(
     *     name="orderId",
     *     in="path",
     *     description="Order id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thisOrder = Order::findOrFail($id);
        $thisOrder->delete();
        return;
    }
}
