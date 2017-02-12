<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Visit;

class MessageController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/messages",
     *   summary="Get all messages",
     *   operationId="GetAllMessages",
     *   tags={"Messages"},
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
        return Message::all();
    }


    /**
     * @SWG\Post(
     *   path="/messages",
     *   summary="Save a message",
     *   operationId="SaveMessage",
     *   tags={"Messages"},
     *   @SWG\Parameter(
     *     name="text",
     *     in="formData",
     *     description="message context",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="visit_id",
     *     in="formData",
     *     description="visit Id",
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
        return $visit->messages()->create([
                'text' => $request->text,
            ]);
    }

    /**
     * @SWG\Get(
     *   path="/messages/{messageId}",
     *   summary="Get a Message",
     *   operationId="GetMessage",
     *   tags={"Messages"},
     *   @SWG\Parameter(
     *     name="messageId",
     *     in="path",
     *     description="Message id",
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
        return Message::findOrFail($id);
    }

    /**
     * @SWG\Delete(
     *   path="/messages/{messageId}",
     *   summary="Delete a message",
     *   operationId="DeleteMessage",
     *   tags={"Messages"},
     *   @SWG\Parameter(
     *     name="messageId",
     *     in="path",
     *     description="Message id",
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
        $thisMessage = Message::findOrFail($id);
        $thisMessage->delete();
        return;
    }
}
