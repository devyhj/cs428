<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\User;

class RestaurantController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/restaurants",
     *   summary="Get all restaurants",
     *   operationId="GetAllRestaurants",
     *   tags={"Restaurants"},
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
        return Restaurant::all();
    }


    /**
     * @SWG\Post(
     *   path="/restaurants",
     *   summary="Save a restaurant",
     *   operationId="SaveRestaurant",
     *   tags={"Restaurants"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Restaurant name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_line1",
     *     in="formData",
     *     description="address line 1",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_line2",
     *     in="formData",
     *     description="address line 2",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="city",
     *     in="formData",
     *     description="city",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="state",
     *     in="formData",
     *     description="state",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="zip_code",
     *     in="formData",
     *     description="zip code",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="user_id",
     *     in="formData",
     *     description="owner's user Id",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="API Token",
     *     required=true,
     *     type="string"
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
        $owner = User::findOrFail($request->user_id);
        return $owner->restaurants()->create([
                'name' => $request->name,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code
            ]);
    }

    /**
     * @SWG\Get(
     *   path="/restaurants/{restaurantId}",
     *   summary="Get a Restaurant",
     *   operationId="GetRestaurant",
     *   tags={"Restaurants"},
     *   @SWG\Parameter(
     *     name="restaurantId",
     *     in="path",
     *     description="Restaurant id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="API Token",
     *     required=true,
     *     type="string"
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
        return Restaurant::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @SWG\Put(
     *   path="/restaurants/{restaurantId}",
     *   summary="Update a restaurant",
     *   operationId="UpdateRestaurant",
     *   tags={"Restaurants"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Restaurant name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_line1",
     *     in="formData",
     *     description="address line 1",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_line2",
     *     in="formData",
     *     description="address line 2",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="city",
     *     in="formData",
     *     description="city",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="state",
     *     in="formData",
     *     description="state",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="zip_code",
     *     in="formData",
     *     description="zip code",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="restaurantId",
     *     in="path",
     *     description="Restaurant Id",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="API Token",
     *     required=true,
     *     type="string"
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
        $thisRestaurant = Restaurant::findOrFail($id);
        $thisRestaurant->name = $request->name;
        $thisRestaurant->address_line1 = $request->address_line1;
        $thisRestaurant->address_line2 = $request->address_line2;
        $thisRestaurant->city = $request->city;
        $thisRestaurant->state = $request->state;
        $thisRestaurant->zip_code = $request->zip_code;
        $thisRestaurant->save();
        return $thisRestaurant;
    }

    /**
     * @SWG\Delete(
     *   path="/restaurants/{restaurantId}",
     *   summary="Delete a Restaurant",
     *   operationId="DeleteRestaurant",
     *   tags={"Restaurants"},
     *   @SWG\Parameter(
     *     name="restaurantId",
     *     in="path",
     *     description="Restaurant id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="API Token",
     *     required=true,
     *     type="string"
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
        $thisRestaurant = Restaurant::findOrFail($id);
        $thisRestaurant->delete();
        return;
    }

    /**
     * @SWG\Get(
     *   path="/restaurants/menus/{restaurantId}",
     *   summary="Get a Restaurant with menu",
     *   operationId="GetRestaurantWithMenu",
     *   tags={"Restaurants"},
     *   @SWG\Parameter(
     *     name="restaurantId",
     *     in="path",
     *     description="Restaurant id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="API Token",
     *     required=true,
     *     type="string"
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
    public function showWithMenus($restaurantId)
    {
        return Restaurant::with('menuCategories.menus.menuOptions')->findOrFail($restaurantId);
    }
}
