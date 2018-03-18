<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserHandlerController extends Controller
{
    public function register(Request $request){
        if(!$request->name or !$request->email or !$request->password){
            return Response::json([
                'status' => 'false',
                'message' => 'Provide enough information!'
            ], 422);
        }
        $email = DB::table('users')->where('email', $request->email)->first();
        if($email){
            return Response::json([
                'status' => 'false',
                'message' => 'Already in use!'
            ], 422);
        }else{
            $request['password'] = bcrypt($request->password);
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
            $user = User::create($request->all());
            $token = JWTAuth::fromUser($user);
            $user->profile_img = 'user_profile_'.$request->email.'.jpg';
            $user->background_img = 'user_background_'.$request->email.'.jpg';
            $user->save();
            $age = date_diff(date_create($request->dob), date_create('today'))->y;
            $user->age = $age;
            
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
                'message' => 'Registration successful!',
                'user' => [$user],
                'token' => $token
            ], 200);
        }
    }

    public function login(Request $request){
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

        // if no errors are encountered we can return a JWT
        return response()->json([
            'status' => 'true',
            'message' => 'Successfully logged in!',
            compact('token')
        ], 200);
    }
}
