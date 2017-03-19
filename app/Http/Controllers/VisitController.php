<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Restaurant;
use App\User;
use Carbon\Carbon;
use Validator;

class VisitController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/visits",
     *   summary="Get all visits",
     *   operationId="GetAllVisits",
     *   tags={"Visits"},
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
        return Visit::all();
    }


    /**
     * @SWG\Post(
     *   path="/visits",
     *   summary="Save a visit",
     *   operationId="SaveVisit",
     *   tags={"Visits"},
     *   @SWG\Parameter(
     *     name="user_id",
     *     in="formData",
     *     description="Visitor's user id",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Parameter(
     *     name="restaurant_id",
     *     in="formData",
     *     description="Visited restaurant id",
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        if ($validator->fails()) {
            return [
                'message' => 'Input validation failed',
                'errors' => $validator->errors()
            ];
        }

        $user = User::findOrFail($request->user_id);
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        $visit = new Visit;

        $visit->start_time = Carbon::now()->toDateTimeString();
        $visit->user()->associate($user);
        $visit->restaurant()->associate($restaurant);

        $visit->save();

        return $visit;
    }

    /**
     * @SWG\Get(
     *   path="/visits/{visitId}",
     *   summary="Get a visit",
     *   operationId="GetVisit",
     *   tags={"Visits"},
     *   @SWG\Parameter(
     *     name="visitId",
     *     in="path",
     *     description="Visit id",
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
        return Visit::findOrFail($id);
    }

    /**
     * @SWG\Put(
     *   path="/visits/{visitId}",
     *   summary="End visit",
     *   operationId="EndVisit",
     *   tags={"Visits"},
     *   @SWG\Parameter(
     *     name="visitId",
     *     in="path",
     *     description="Visit Id",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thisVisit = Visit::findOrFail($id);
        $thisVisit->end_time = Carbon::now()->toDateTimeString();
        $thisVisit->save();
        return $thisVisit;
    }

    /**
     * @SWG\Delete(
     *   path="/visits/{visitId}",
     *   summary="Delete a visit",
     *   operationId="DeleteVisit",
     *   tags={"Visits"},
     *   @SWG\Parameter(
     *     name="visitId",
     *     in="path",
     *     description="Visit id",
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
        $thisVisit = Visit::findOrFail($id);
        $thisVisit->delete();
        return;
    }

    /**
     * @SWG\Get(
     *   path="/visits/orders/{visitId}",
     *   summary="Get orders for this visit",
     *   operationId="GetVisitOrders",
     *   tags={"Visits"},
     *   @SWG\Parameter(
     *     name="visitId",
     *     in="path",
     *     description="Visit id",
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
    public function getVisitOrders($visitId)
    {
        return Visit::with('orders.menuItem')->findOrFail($visitId);
    }
}
