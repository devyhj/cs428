<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuOption;
use App\Menu;
use Validator;

class MenuOptionController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/options",
     *   summary="Get all menu options",
     *   operationId="GetAllOptions",
     *   tags={"Options"},
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
        return MenuOption::all();
    }


    /**
     * @SWG\Post(
     *   path="/options",
     *   summary="Save an option",
     *   operationId="SaveOption",
     *   tags={"Options"},
     *   @SWG\Parameter(
     *     name="menu_id",
     *     in="formData",
     *     description="which menu",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Option name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="formData",
     *     description="Option description",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="price",
     *     in="formData",
     *     description="price of option",
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
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required',
            'description' => 'required',
            'additional_price' => 'numeric'
        ]);

        if ($validator->fails()) {
            return [
                'message' => 'Input validation failed',
                'errors' => $validator->errors()
            ];
        }


        $menu = Menu::findOrFail($request->menu_id);
        $newMenuOption = $menu->menuOptions()->create([
                'name' => $request->name,
                'description' => $request->description,
                'additional_price' => $request->price,
            ]);
        return $newMenuOption;
    }

    /**
     * @SWG\Get(
     *   path="/options/{optionId}",
     *   summary="Get an option",
     *   operationId="GetOption",
     *   tags={"Options"},
     *   @SWG\Parameter(
     *     name="optionId",
     *     in="path",
     *     description="Option id",
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
        return MenuOption::findOrFail($id);
    }

    /**
     * @SWG\Put(
     *   path="/options/{optionId}",
     *   summary="Update option",
     *   operationId="updateOption",
     *   tags={"Options"},
     *   @SWG\Parameter(
     *     name="optionId",
     *     in="path",
     *     description="Which Option",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Option name",
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
     *     description="price of option",
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'numeric'
        ]);

        if ($validator->fails()) {
            return [
                'message' => 'Input validation failed',
                'errors' => $validator->errors()
            ];
        }

        $option = MenuOption::findOrFail($id);
        $option->name = $request->name;
        $option->description = $request->description;
        $option->additional_price = $request->price;
        $option->save();

        return $option;
    }

    /**
     * @SWG\Delete(
     *   path="/options/{optionId}",
     *   summary="Delete an option",
     *   operationId="DeleteOption",
     *   tags={"Options"},
     *   @SWG\Parameter(
     *     name="optionId",
     *     in="path",
     *     description="Option id",
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
        $thisOption = MenuOption::findOrFail($id);
        $thisOption->delete();
        return;
    }
}
