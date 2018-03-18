<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ratings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Mockery\CountValidator\Exception;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index(){
        $users = User::all();
        return Response::json([
            'status' => 'true',
            'message' => 'Successfully fetched data!',
            'package' => $users
        ], 200);
    }

    public function show($id){
        $user = User::find($id);
        if(!$user){
            return Response::json([
                'status' => 'false',
                'message' => 'User does not exist!'
            ], 404);
        }
        
        $pro_img = URL::asset('/uploads/'.$user->profile_img);
        $images = null;
        $user->profile_img = $pro_img;

        if(!@getimagesize($pro_img)){
            $imgDir = public_path('/images/random_pp/');
            $images = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
            $user->profile_img = URL::asset('/images/random_pp/'.$images[array_rand($images)]);
        }

        $bg_img = URL::asset('/uploads/'.$user->background_img);
        $images = null;
        $user->background_img = $bg_img;

        if(!@getimagesize($bg_img)){
            $imgDir = public_path('/images/random_bg/');
            $images = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
            $user->background_img = URL::asset('/images/random_bg/'.$images[array_rand($images)]);
        }

        return Response::json([
            'status' => 'true',
            'message' => 'User successfully fetched!',
            'User' => $user
        ], 200);
    }

    public function store(Request $request){
        if(!$request->name or !$request->email or !$request->password){
            return Response::json([
                'status' => 'false',
                'message' => 'Provide enough information!'
            ], 422);
        }

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());

        return Response::json([
            'status' => 'true',
            'message' => 'User successfully added!'
        ], 200);
    }

    public function update(Request $request, $id){
        if(!$request->name or !$request->email or !$request->password){
            return Response::json([
                'status' => 'false',
                'message' => 'Please Provide enough information!'
            ], 422);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->language = $request->language;
        $user->dob = $request->year.'-'.$request->month.'-'.$request->day;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->contact = $request->contact;
        $user->role = $request->role;
        $user->informations = $request->informations;
        $user->save();

        return Response::json([
            'status' => 'true',
            'message' => 'Information Updated Successfully!'
        ], 200);
    }

    public function destroy($id){
        User::destroy($id);

        return Response::json([
            'status' => 'true',
            'message' => 'User deleted successfully!'
        ], 200);
    }

    public function searchByRole(Request $request){
        $user = User::where('role', $request->role)->get();
        return Response::json([
            'status' => 'true',
            'message' => 'Data fetched successfully!',
            'search' => $user
        ], 200);
    }

    public function editUser(Request $request, $id){
        if(!$request->name or !$request->email or !$request->password){
            return Response::json([
                'status' => 'false',
                'message' => 'Please Provide enough information!'
            ], 422);
        }

        $path = public_path().'/uploads/';
        try{
            if(\Illuminate\Support\Facades\Request::hasFile('profile_img')){
                $profile_photo = \Illuminate\Support\Facades\Request::file('profile_img');
                $profile_photo->move($path, 'user_profile_' .$request->email. '.jpg');
            }
            if(\Illuminate\Support\Facades\Request::hasFile('background_img')){
                $back_photo = \Illuminate\Support\Facades\Request::file('background_img');
                $back_photo->move($path, 'user_background_' . $request->email . '.jpg');
            }
        }catch (Exception $e){
            return Response::json([
                'status' => 'false',
                'message' => 'Could not accept data!',
                'error' => $e
            ]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->language = $request->language;
        $user->dob = $request->dob;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->contact = $request->contact;
        $user->role = $request->role;
        $user->informations = $request->informations;
        $user->payment_status = $request->payment_status;
        $user->profile_img = 'user_profile_'.$request->email.'.jpg';
        $user->background_img = 'user_background_'.$request->email.'.jpg';
        $user->save();

        return Response::json([
            'status' => 'true',
            'message' => 'Information Updated Successfully!',
        ], 200);
    }

    public function searchAgentByPaid(){
        $result = User::where('role', 'agent')->get();

        foreach($result as $key => $userData){
            $count = $totalRating = null;
            $age = date_diff(date_create($userData['dob']), date_create('today'))->y;
            $result[$key]['age'] = $age;
            $allRatingComment = Ratings::where('agent_id', $userData['id'])->get();
            foreach($allRatingComment as $ratingComment){
                if($ratingComment['comment'] != null){
                    $totalRating += $ratingComment['rating'];
                    $count++;
                }
            }
            if($count != null){
                $result[$key]['total-comments'] = $count;
            }else{
                $result[$key]['total-comments'] = 'No comments yet!';
            }
            if($totalRating != null){
                $result[$key]['total-rating'] = $totalRating/$count;
            }else{
                $result[$key]['total-rating'] = 'No ratings yet!';
            }
        }

        return Response::json([
            'status' => 'true',
            'message' => 'Agents with paid status!',
            'user' => $result
        ], 200);
    }

    public function multipleFieldSearch(Request $request){
        $result = User::where('role', 'agent')
            ->where('payment_status', 'paid')
            ->where('country', 'like', '%'.$request->country.'%')
            ->where('city', 'like', '%'.$request->city.'%')
            ->where('language', 'like', '%'.$request->language.'%')
            ->get();
        if(!$result->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'No data found!'
            ], 404);
        }else{
            foreach($result as $key => $userData){
                $count = $totalRating = null;
                $age = date_diff(date_create($userData['dob']), date_create('today'))->y;
                $result[$key]['age'] = $age;
                $allRatingComment = Ratings::where('agent_id', $userData['id'])->get();
                foreach($allRatingComment as $ratingComment){
                    if($ratingComment['comment'] != null){
                        $totalRating += $ratingComment['rating'];
                        $count++;
                    }
                }
                if($count != null){
                    $result[$key]['total-comments'] = $count;
                }else{
                    $result[$key]['total-comments'] = 'No comments yet!';
                }
                if($totalRating != null){
                    $result[$key]['total-rating'] = $totalRating/$count;
                }else{
                    $result[$key]['total-rating'] = 'No ratings yet!';
                }
                
                $pro_img = URL::asset('/uploads/'.$result[$key]['profile_img']);
                $images = null;
                $result[$key]['profile_img'] = $pro_img;

                if(!@getimagesize($pro_img)){
                    $imgDir = public_path('/images/random_pp/');
                    $images = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
                    $result[$key]['profile_img'] = URL::asset('/images/random_pp/'.$images[array_rand($images)]);
                }

                $bg_img = URL::asset('/uploads/'.$result[$key]['background_img']);
                $images = null;
                $result[$key]['background_img'] = $bg_img;

                if(!@getimagesize($bg_img)){
                    $imgDir = public_path('/images/random_bg/');
                    $images = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
                    $result[$key]['background_img'] = URL::asset('/images/random_bg/'.$images[array_rand($images)]);
                }
                
            }
            return Response::json([
                'status' => 'true',
                'message' => 'Search successful!',
                'Result' => $result
            ], 200);
        }
    }
    
    public function resetPassword(Request $request){
        if(!$request->email and !$request->password){
            return Response::json([
                'status' => 'false',
                'message' => 'No data found!!'
            ], 422);
        }
        User::where('email', $request->email)
        ->update(['password' => bcrypt($request->password)]);
        return Response::json([
            'status' => 'true',
            'message' => 'Password updated successfully!!'
        ], 200);
    }

}
