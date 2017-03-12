<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuCategory;
use App\Restaurant;

class MenuCategoryController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/categories",
     *   summary="Get all menu categories",
     *   operationId="GetAllMenuCategories",
     *   tags={"Categories"},
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
        return MenuCategory::all();
    }

    /**
     * @SWG\Post(
     *   path="/categories",
     *   summary="Save a menu category",
     *   operationId="SaveMenuCategory",
     *   tags={"Categories"},
     *   @SWG\Parameter(
     *     name="restaurant_id",
     *     in="formData",
     *     description="which restaurant",
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
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        $newMenuCategory = $restaurant->menuCategories()->create([
                'name' => $request->name,
            ]);
        return $newMenuCategory;
    }

    /**
     * @SWG\Get(
     *   path="/categories/{categoryId}",
     *   summary="Get a menu category",
     *   operationId="GetMenuCategory",
     *   tags={"Categories"},
     *   @SWG\Parameter(
     *     name="categoryId",
     *     in="path",
     *     description="Which Menu Category",
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
        return MenuCategory::with('menuItems.menuOptions')->find($id);
    }


    /**
     * @SWG\Put(
     *   path="/categories/{categoryId}",
     *   summary="Update a menu category",
     *   operationId="UpdateMenuCategory",
     *   tags={"Categories"},
     *   @SWG\Parameter(
     *     name="categoryId",
     *     in="path",
     *     description="Which Menu Category",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Menu category name",
     *     required=true,
     *     type="string"
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
        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->name = $request->name;
        $menuCategory->save();

        return $menuCategory;
    }

    /**
     * @SWG\Delete(
     *   path="/categories/{categoryId}",
     *   summary="Delete a menu category",
     *   operationId="DeleteMenuCategory",
     *   tags={"Categories"},
     *   @SWG\Parameter(
     *     name="categoryId",
     *     in="path",
     *     description="Which Menu Category",
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
        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->delete();

        return;
    }
}
