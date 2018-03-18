<?php

namespace App\Http\Controllers;

use App\Ratings;
use Illuminate\Http\Request;
use App\AvailableDates;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class AvailableDatesController extends Controller
{

    public function show($id){
        $result = AvailableDates::where('user_id', $id)->get();
        foreach($result as $key => $data){
            $result[$key]['available_dates'] = explode(',', $data['available_dates']);
        }
        return Response::json([
            'status' => 'true',
            'message' => 'Data fetched successfully!',
            'data' => $result
        ], 200);
    }

    public function store(Request $request){
        if(!$request->agent_id or !$request->available_dates){
            return Response::json([
                'status' => 'false',
                'message' => 'No data found!'
            ], 422);
        }

        $dates['user_id'] = $request->agent_id;
        $dates['available_dates'] = $request->available_dates;

        AvailableDates::create($dates);

        return Response::json([
            'status' => 'true',
            'message' => 'Dates added successfully!'
        ], 200);
    }

    public function update(Request $request, $id){
        if(!$request->available_dates){
            return Response::json([
                'status' => 'false',
                'message' => 'Not enough data found!'
            ], 422);
        }

        $data = AvailableDates::find($id);
        //$data['user_id'] = $request->agent_id;
        $data->available_dates = $request->available_dates;
        $data->save();

        return Response::json([
            'status' => 'true',
            'message' => 'Data updated successfully!'
        ], 200);

    }

    public function destroy($id){
        $checkUser = AvailableDates::where('id', $id)->get();
        if(!$checkUser->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'Not found!'
            ], 404);
        }
        AvailableDates::destroy($id);
        return Response::json([
            'status' => 'true',
            'message' => 'Delete Successful!'
        ], 200);
    }
}
