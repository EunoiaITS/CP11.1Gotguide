<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Ratings;
use Illuminate\Support\Facades\Response;

class RatingsController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index(){
        $ratings = Ratings::all();
        return Response::json([
            'status' => 'true',
            'message' => 'Successfully fetched data!',
            'ratings' => $ratings
        ], 200);
    }

    public function show($id){
        $rating = Ratings::find($id);
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
        if(!$request->agent_id or !$request->user_id or !$request->rating){
            return Response::json([
                'status' => 'false',
                'message' => 'Provide enough information!'
            ], 422);
        }

        $rating = Ratings::create($request->all());

        return Response::json([
            'status' => 'true',
            'message' => 'Rating successfully added!'
        ], 200);
    }

    public function update(Request $request, $id){
        if(! $request->agent_id or ! $request->user_id or ! $request->rating){
            return Response::json([
                'status' => 'false',
                'message' => 'Please Provide enough information!'
            ], 422);
        }

        $rating = Ratings::find($id);
        $rating->agent_id = $request->agent_id;
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
        Ratings::destroy($id);

        return Response::json([
            'status' => 'true',
            'message' => 'Rating deleted successfully!'
        ], 200);
    }

    public function totalRatingOfAgent($id){
        $total = $finalRate = $count = '';
        $result = Ratings::where('agent_id', $id)->get();
        foreach($result as $data){
            $total += $data['rating'];
            $count++;
        }
        if($total != null){
            $finalRate = $total/$count;
            return Response::json([
                'status' => 'true',
                'message' => 'Data fetched successfully!',
                'total-rating' => $finalRate,
                'all-ratings' => $result
            ], 200);
        }else{
            return Response::json([
                'status' => 'false',
                'message' => 'No ratings yet!'
            ], 404);
        }
    }

    public function commentsOnAgent($id){
        $count = null;
        $comments = array();
        $result = Ratings::where('agent_id', $id)->get();
        foreach($result as $data){
            if($data['comment'] != null){
                $theUser = User::where('id', $data['user_id'])->get();
                foreach($theUser as $k => $u){
                    //$comments[]['id'] = $u['id'];
                    $comments[$u['id']]['name'] = $u['name'];
                    $comments[$u['id']]['comment'] = $data['comment'];
                    $comments[$u['id']]['rating'] = $data['rating'];
                }
                $count++;
            }
        }

        if($count != null){
            return Response::json([
                'status' => 'true',
                'message' => 'All comments!',
                'total-comments' => $count,
                'comments' => $comments
            ], 200);
        }else{
            return Response::json([
                'status' => 'false',
                'message' => 'No comments yet!'
            ], 404);
        }
    }

}
