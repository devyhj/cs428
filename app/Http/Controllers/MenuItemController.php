<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuItem;
use App\MenuCategory;



class MenuItemController extends Controller
{

    /**
     * @SWG\Get(
     *   path="/menu_items",
     *   summary="Get all menu items",
     *   operationId="GetAllMenuItems",
     *   tags={"MenuItems"},
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
        return MenuItem::all();
    }

    /**
     * @SWG\Post(
     *   path="/menu_items",
     *   summary="Save a menuItem",
     *   operationId="SaveMenuItem",
     *   tags={"MenuItems"},
     *   @SWG\Parameter(
     *     name="menu_category_id",
     *     in="formData",
     *     description="which menu category",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="MenuItem name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="formData",
     *     description="description",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="price",
     *     in="formData",
     *     description="price of item",
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
        $menuCategory = MenuCategory::findOrFail($request->menu_category_id);
        $newMenu = $menuCategory->menuItems()->create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price
            ]);
        return $newMenu;
    }

    /**
     * @SWG\Get(
     *   path="/menu_items/{itemId}",
     *   summary="Get a menu Item",
     *   operationId="GetMenuItem",
     *   tags={"MenuItems"},
     *   @SWG\Parameter(
     *     name="itemId",
     *     in="path",
     *     description="Menu Item id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return MenuItem::with('menuOptions')->find($id);
    }


    /**
     * @SWG\Put(
     *   path="/menu_items/{itemId}",
     *   summary="Update a menu item",
     *   operationId="UpdateMenuItem",
     *   tags={"MenuItems"},
     *   @SWG\Parameter(
     *     name="itemId",
     *     in="path",
     *     description="Which Menu Item",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Menu name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="formData",
     *     description="description",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="price",
     *     in="formData",
     *     description="price of menu item",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->name = $request->name;
        $menuItem->description = $request->description;
        $menuItem->price = $request->price;
        $menuItem->save();

        return $menuItem;
    }

    /**
     * @SWG\Delete(
     *   path="/menu_items/{itemId}",
     *   summary="Delete a menu item",
     *   operationId="DeleteMenuItem",
     *   tags={"MenuItems"},
     *   @SWG\Parameter(
     *     name="itemId",
     *     in="path",
     *     description="which menu item",
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
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return;
    }
}
