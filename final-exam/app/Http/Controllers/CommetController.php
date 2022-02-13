<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CommetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Commet::with('user', 'post')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cm = new Commet();
        $cm->post_id = $request->post_id;
        $cm->user_id = $request->user_id;
        $cm->comment = $request->comment;
        $cm->save();
        return response()->json([
            'massage'=>'Comment is created',
            'data'=> $cm
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Commet::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cm = Commet::findOrFail($id);
        $cm->commet = $request->commet;
        $cm->save();
        return response()->json([
            'massage'=>'Updated',
            'data'=> $cm
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Commet::destroy($id);
        if($isDeleted == 1){
            return response()->json(['massage'=>'Commet is deleted'], 200);
        }else{
            return response()->json(['massage'=>'Not Found'], 404);
        }
    }
}
