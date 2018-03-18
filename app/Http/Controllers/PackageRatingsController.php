<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PackageRatings;
use Illuminate\Support\Facades\Response;

class PackageRatingsController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index(){
        $ratings = PackageRatings::all();
        return Response::json([
            'status' => 'true',
            'message' => 'Successfully fetched data!',
            'ratings' => $ratings
        ], 200);
    }

    public function show($id){
        $rating = PackageRatings::find($id);
        if(!$rating){
            return Response::json([
                'status' => 'false',
                'message' => 'No ratings!'
            ], 404);
        }

        return Response::json([
            'status' => 'true',
            'message' => 'Data successfully fetched!',
            'Rating' => $rating
        ], 200);
    }

    public function store(Request $request){
        if(!$request->package_id or !$request->user_id or !$request->rating){
            return Response::json([
                'status' => 'false',
                'message' => 'Provide enough information!'
            ], 422);
        }

        $rating = PackageRatings::create($request->all());

        return Response::json([
            'status' => 'true',
            'message' => 'Rating successfully added!'
        ], 200);
    }

    public function update(Request $request, $id){
        if(! $request->package_id or ! $request->user_id or ! $request->rating){
            return Response::json([
                'status' => 'false',
                'message' => 'Please Provide enough information!'
            ], 422);
        }

        $rating = PackageRatings::find($id);
        $rating->package_id = $request->package_id;
        $rating->user_id = $request->user_id;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->save();

        return Response::json([
            'status' => 'true',
            'message' => 'Information Updated Successfully!'
        ], 200);
    }

    public function destroy($id){
        PackageRatings::destroy($id);

        return Response::json([
            'status' => 'true',
            'message' => 'Rating deleted successfully!'
        ], 200);
    }

}
