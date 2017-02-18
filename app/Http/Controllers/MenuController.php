<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\MenuCategory;



class MenuController extends Controller
{

    /**
     * @SWG\Get(
     *   path="/menus",
     *   summary="Get all menus",
     *   operationId="GetAllMenu",
     *   tags={"Menus"},
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
        return Menu::all();
    }

    /**
     * @SWG\Post(
     *   path="/menus",
     *   summary="Save a menu",
     *   operationId="SaveMenu",
     *   tags={"Menus"},
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
     *     description="price of menu",
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
        $newMenu = $menuCategory->menus()->create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price
            ]);
        return $newMenu;
    }

    /**
     * @SWG\Get(
     *   path="/menus/{menuId}",
     *   summary="Get a menu",
     *   operationId="GetMenu",
     *   tags={"Menus"},
     *   @SWG\Parameter(
     *     name="menuId",
     *     in="path",
     *     description="Menu id",
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
        return Menu::with('menuOptions')->find($id);
    }


    /**
     * @SWG\Put(
     *   path="/menus/{menuId}",
     *   summary="Update a menu",
     *   operationId="UpdateMenu",
     *   tags={"Menus"},
     *   @SWG\Parameter(
     *     name="menuId",
     *     in="path",
     *     description="Which Menu",
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
     *     description="price of menu",
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
        $menu = Menu::findOrFail($id);
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->save();

        return $menu;
    }

    /**
     * @SWG\Delete(
     *   path="/menus/{menuId}",
     *   summary="Delete a menu",
     *   operationId="DeleteMenu",
     *   tags={"Menus"},
     *   @SWG\Parameter(
     *     name="menuId",
     *     in="path",
     *     description="which menu",
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
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return;
    }
}
