<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use Illuminate\Http\Request;
use App\Http\Resources\ReadingCollection;
use Illuminate\Support\Facades\Log;

class ReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // all readings
        $readings = Reading::where('read_status', 0)->paginate(6);
        
        return response([
                    "status" => "success",
                    "data" =>  $readings 
                    ],  200)
                  ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //
        $reading = new Reading([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'abstract' => $request->input('abstract')
        ]);
        $reading->save();
 
        return response()->json('The reading was successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reading  $reading
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Reading::where('id', $request->input('reading_id'))->update(array('read_status' => 1));
 
        return response([
            "status" => "success",
            "message" => "Success, the reading was successfully added to already read",
            ],  200)
          ->header('Content-Type', 'application/json');
    }

}
