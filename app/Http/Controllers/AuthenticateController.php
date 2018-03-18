<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Ratings;
use App\UserPayments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    public function __construct(){
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    public function index(){
        return "Auth index";
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Invalid credentials!'
                ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json([
                'status' => 'false',
                'message' => 'Could not create token!'
            ], 500);
        }

        $user = User::where('email', $request->email)->get();
        $dob = null;
        foreach($user as $data){
            $dob = $data['dob'];
        }

        if($user[0]['role'] == 'agent'){
            $count = $totalRating = null;
            $user[0]['total-rating'] = 'No ratings yet!';
            $user[0]['total-comments'] = 'No comments yet!';
            $allRatingComment = Ratings::where('agent_id', $user[0]['id'])->get();
            foreach($allRatingComment as $ratingComment){
                if($ratingComment['comment'] != null){
                    $totalRating += $ratingComment['rating'];
                    $count++;
                }
            }
            if($count != null){
                $user[0]['total-comments'] = $count;
            }
            if($totalRating != null){
                $user[0]['total-rating'] = $totalRating/$count;
            }
            
            $paymentCheck = UserPayments::where('user_id', $user[0]['id'])->get();
            if($paymentCheck->first()){
                $expiryCheck = date_diff(date_create($paymentCheck[0]['payment_expiry']), date_create('today'))->d;
                $user[0]['expiry_date'] = $expiryCheck;
                $today = date_create('today');
                $expiryDate = date_create($paymentCheck[0]['payment_expiry']);
                if($today >= $expiryDate){
                    $user[0]['payment_expiry'] = 'finished!';
                    User::where('id', $user[0]['id'])
                        ->update(['payment_status' => 'unpaid']);
                    $user[0]['payment_status'] = 'unpaid';
                }else{
                    $user[0]['payment_expiry'] = 'Not finished!';
                }
            }else{
                $user[0]['payment_expiry'] = 'No payments made!';
            }
            
        }

        $age = date_diff(date_create($dob), date_create('today'))->y;
        $user[0]['age'] = $age;
        
        $pro_img = URL::asset('/uploads/'.$user[0]['profile_img']);
        $images = null;
        $user[0]['profile_img'] = $pro_img;

        if(!@getimagesize($pro_img)){
            $imgDir = public_path('/images/random_pp/');
            $images = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
            $user[0]['profile_img'] = URL::asset('/images/random_pp/'.$images[array_rand($images)]);
        }

        $bg_img = URL::asset('/uploads/'.$user[0]['background_img']);
        $images = null;
        $user[0]['background_img'] = $bg_img;

        if(!@getimagesize($bg_img)){
            $imgDir = public_path('/images/random_bg/');
            $images = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
            $user[0]['background_img'] = URL::asset('/images/random_bg/'.$images[array_rand($images)]);
        }

        // if no errors are encountered we can return a JWT
        return response()->json([
            'status' => 'true',
            'message' => 'Logged in successfully!',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'User not found!'
                ], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json([
                'status' => 'false',
                'message' => 'Token expired!'
            ], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json([
                'status' => 'false',
                'message' => 'Token invalid!'
            ], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json([
                'status' => 'false',
                'message' => 'Token absent!'
            ], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

}
