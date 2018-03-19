<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Countries;
use App\Languages;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\User;
use App\Ratings;
use App\AvailableDates;
use App\packages;
use App\VerifyUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Auth;

class WebController extends Controller
{
    public function __construct()
    {
        $languages = Languages::all();
        $cities = Cities::all();
        $countries = Countries::all();
        View::share(['languages'=> $languages,'cities'=>$cities,'countries'=>$countries]);
    }

    public function home(){
        return view('landing-page.landing');
    }
    public function searchResult(Request $request){
        $result = User::where('role', 'agent')
            ->Where('payment_status', 'paid')
            ->Where('country', 'like', '%'.trim($request->country).'%')
            ->Where('city', 'like', '%'.trim($request->city).'%')
            ->Where('language', 'like', '%'.trim($request->language).'%')
            ->get();
        if(!$result->first()){
            $result->error = "Your Desired Search Result Not Found !!";
            $result->header = "includes.error-header";
            return view('pages.error', ['result' => $result]);
        }else{
            $finalResult = new \stdClass();
            foreach($result as $key => $userData){
                $count = $totalRating = null;
                $age = date_diff(date_create($userData->dob), date_create('today'))->y;
                $result->age = $age;
                $allRatingComment = Ratings::where('agent_id', $userData->id)->get();
                foreach($allRatingComment as $ratingComment){
                    if($ratingComment->comment != null){
                        $totalRating += $ratingComment->rating;
                        $count++;
                    }
                }
                if($count != null){
                    $result->total_comments = $count;
                }else{
                    $result->total_comments = 'No comments yet!';
                }
                if($totalRating != null){
                    $result->total_rating = $totalRating/$count;
                }else{
                    $result->total_rating = 'No ratings yet!';
                }

            }
            $finalResult->header = 'includes.search-result-header';
            $finalResult->users = $result;
            return view('pages.search-result', ['result' => $finalResult]);
        }
    }

    public function showAgentProfile($id){
        $user = User::find($id);
        if(!$user){
            $error = new \stdClass();
            $error->error = "No such user found!!";
            $error->header = 'includes.error-header';
            return view('pages.error', ['result' => $error]);
        }
        
        if($user->role != 'agent'){
            return redirect()->back()->with('error-message', 'This is not a guide!');
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

        $allDates = AvailableDates::where(['user_id' => $id])->get();
        $user->availableDates = $allDates;
        $user->packages = packages::where(['agent_id' => $id])->get();

        $allRates = Ratings::where(['agent_id' => $id])->get();
        $total = $finalRate = $count = 0;
        foreach($allRates as $data){
            $total += $data->rating;
            $count++;
        }
        if($total != null){
            $finalRate = $total/$count;
            $user->avgRate = $finalRate;
        }else{
            $user->avgRate = 0;
        }

        $user->header = 'includes.agent-profile-header';

        return view('pages.agent-profile', ['result' => $user]);
    }

    public function userRegister(Request $request){
        $error = null;
        if($request->fname == ''){
            $error .= "Please provide first name!\r\n";
        }
        if($request->lname == ''){
            $error .= "Please provide last name!\r\n";
        }
        if($request->remail != $request->email){
            $error .= "Email didn't match!\r\n";
        }
        $email = DB::table('users')->where('email', $request->email)->first();
        if($email){
            $error .= "Email already in use!\r\n";
        }
        if($request->repass != $request->password){
            $error .= "Password didn't match!\r\n";
        }
        if(!isset($request->selector)){
            $error .= "Please agree with the terms and conditions!\r\n";
        }
        if($error != null){
            return redirect()->back()->with('gs-message', $error);
        }
        $user = array();
        $user['name'] = $request->fname.' '.$request->lname;
        $user['email'] = $request->email;
        $user['password'] = bcrypt($request->password);
        $user['language'] = $request->language;
        $user['role'] = 'traveller';
        $user['payment_status'] = 'nv';
        $user['dob'] = $request->year.'-'.$request->month.'-'.$request->day;
        $user['profile_img'] = 'user_profile_'.$request->email.'.jpg';
        $user['background_img'] = 'user_background_'.$request->email.'.jpg';
        try{
            User::create($user);
        }catch (QueryException $e){
            $error .= "Something went wrong!!\r\n";
        }
        if($error != null){
            return redirect()->back()->with('gs-message', $error);
        }
        return redirect()->to('sign-in/user')->with('suc-message', "Registration successful! Please login!");
    }

    public function userLogin(Request $request){
        if(Auth::user()){
            return redirect()->to('profile/user');
        }
        $result = new \stdClass();
        if($request->isMethod('post')){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'traveller'])){
                return redirect('profile/user');
            }else{
                return redirect()->back()->with('message', 'Wrong username/password!!');
            }
        }
        $result->header = 'includes.user-login-header';
        return view('pages.user-login', ['result' => $result]);
    }

    public function userProfile(){
        if(Auth::user()){
            $id = Auth::id();
            $user = User::find($id);

            if($user->role != 'traveller'){
                return redirect()->back();
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
            $user->header = 'includes.user-profile-header';
            return view('pages.user-profile', ['result' => $user]);

        }else{
            return redirect('sign-in/user');
        }
    }

    public function editUserProfile(Request $request){
        if(Auth::user()){
            $id = Auth::id();
            $user = User::find($id);
            $email = Auth::user()->email;

            if($user->role != 'traveller'){
                return redirect()->back();
            }

            if ($request->isMethod('post')) {
                $path = public_path().'/uploads/';
                try{
                    if(\Illuminate\Support\Facades\Request::hasFile('profile_img')){
                        $profile_photo = \Illuminate\Support\Facades\Request::file('profile_img');
                        $profile_photo->move($path, 'user_profile_' .$email. '.jpg');
                    }
                    if(\Illuminate\Support\Facades\Request::hasFile('background_img')){
                        $back_photo = \Illuminate\Support\Facades\Request::file('background_img');
                        $back_photo->move($path, 'user_background_'.$email . '.jpg');
                    }
                }catch (Exception $e){
                    return Response::json([
                        'status' => 'false',
                        'message' => 'Could not accept data!',
                        'error' => $e
                    ]);
                }
                $user->profile_img = 'user_profile_'.$email.'.jpg';
                $user->background_img = 'user_background_'.$email.'.jpg';
                $user->save();

                if(isset($_POST['userInfo'])) {
                    $user->name = $request->name;
                    if(isset($request->language)){
                        $allLang = '';
                        foreach($request->language as $lang){
                            $allLang .= ';'.$lang;
                        }
                        $user->language = ltrim($allLang, ';');
                    }
                    $user->dob = $request->year . '-' . $request->month . '-' . $request->day;
                    $user->country = $request->country;
                    $user->city = $request->city;
                    $user->contact = $request->contact;
                    $user->save();
                }
                return redirect()->to('profile/edit/user')->with('save-message', 'Information saved successfully!');
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

            $user->languages = Languages::all();
            $user->cities = Cities::all();
            $user->countries = Countries::all();
            $user->header = 'includes.edit-user-header';
            return view('pages.edit-user-profile', ['result' => $user]);
        }else{
            return redirect('sign-in/user');
        }
    }
    public function guideRegister(Request $request){
        $error = null;
        if($request->fname == ''){
            $error .= "Please provide first name!\r\n";
        }
        if($request->lname == ''){
            $error .= "Please provide last name!\r\n";
        }
        if($request->remail != $request->email){
            $error .= "Email didn't match!\r\n";
        }
        if($request->repass != $request->password){
            $error .= "Password didn't match!\r\n";
        }
        if(!isset($request->selector)){
            $error .= "Please agree with the terms and conditions!\r\n";
        }
        if($error != null){
            return redirect()->back()->with('gs-message', $error);
        }
        $user = array();
        $user['name'] = $request->fname.' '.$request->lname;
        $user['email'] = $request->email;
        $user['password'] = bcrypt($request->password);
        $user['city'] = $request->city;
        $user['country'] = $request->country;
        $user['language'] = $request->language;
        $user['role'] = 'agent';
        $user['payment_status'] = 'unpaid';
        $user['dob'] = $request->year.'-'.$request->month.'-'.$request->day;
        $user['profile_img'] = 'user_profile_'.$request->email.'.jpg';
        $user['background_img'] = 'user_background_'.$request->email.'.jpg';
        try{
            User::create($user);
        }catch (QueryException $e){
            $error .= "Something went wrong!!\r\n";
        }
        if($error != null){
            return redirect()->back()->with('gs-message', $error);
        }
        return redirect()->to('sign-in/guide')->with('suc-message', "Registration successful! Please login!");
    }
    public function guideLogin(Request $request){
        if(Auth::user()){
            return redirect()->to('profile/guide');
        }
        $result = new \stdClass();
        if($request->isMethod('post')){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'agent'])){
                return redirect('profile/guide');
            }else{
                return redirect()->back()->with('message', 'Wrong username/password!!');
            }
        }
        $result->header = 'includes.guide-login-header';
        return view('pages.guide-login', ['result' => $result]);
    }

    public function guideProfile(){
        if(Auth::user()){
            $id = Auth::id();
            $user = User::find($id);

            if($user->role != 'agent'){
                return redirect()->back();
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

            $allDates = AvailableDates::where(['user_id' => $id])->get();
            $user->availableDates = $allDates;
            $user->packages = packages::where(['agent_id' => $id])->get();

            $allRates = Ratings::where(['agent_id' => $id])->get();
            $total = $finalRate = $count = 0;
            foreach($allRates as $data){
                $total += $data->rating;
                $count++;
            }
            if($total != null){
                $finalRate = $total/$count;
                $user->avgRate = $finalRate;
            }else{
                $user->avgRate = 0;
            }

            $user->header = 'includes.guide-profile-header';
            return view('pages.guide-profile', ['result' => $user]);
        }else{
            return redirect('sign-in/guide');
        }
    }

    public function checkReviews(){
        if(Auth::user()){
            $id = Auth::id();
            $user = User::find($id);

            if($user->role != 'agent'){
                return redirect()->back();
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

            $allComments = Ratings::where('agent_id', $id)->get();
            $user->comments = $allComments;

            $total = $finalRate = $count = 0;
            foreach($allComments as $data){
                $total += $data->rating;
                $count++;
            }
            if($total != null){
                $finalRate = $total/$count;
                $user->avgRate = $finalRate;
            }else{
                $user->avgRate = 0;
            }

            foreach($allComments as $comments){
                $commenter = User::find($comments->user_id);
                $comments->commenter = $commenter->name;
                $c_img = URL::asset('/uploads/'.$commenter->profile_img);
                $imgs = null;
                $comments->profile_img = $c_img;

                if(!@getimagesize($c_img)){
                    $imgDir = public_path('/images/random_pp/');
                    $imgs = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
                    $comments->profile_img = URL::asset('/images/random_pp/'.$imgs[array_rand($imgs)]);
                }
            }

            $user->header = 'includes.guide-profile-header';
            return view('pages.check-reviews', ['result' => $user]);
        }else{
            return redirect('sign-in/guide');
        }
    }

    public function editGuideProfile(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);
            $email = Auth::user()->email;

            if ($user->role != 'agent') {
                return redirect()->back();
            }
            if ($request->isMethod('post')) {
                $path = public_path().'/uploads/';
                try{
                    if(\Illuminate\Support\Facades\Request::hasFile('profile_img')){
                        $profile_photo = \Illuminate\Support\Facades\Request::file('profile_img');
                        $profile_photo->move($path, 'guide_profile_' .$email. '.jpg');
                    }
                    if(\Illuminate\Support\Facades\Request::hasFile('background_img')){
                        $back_photo = \Illuminate\Support\Facades\Request::file('background_img');
                        $back_photo->move($path, 'guide_background_'.$email . '.jpg');
                    }
                }catch (Exception $e){
                    return Response::json([
                        'status' => 'false',
                        'meot accept data!',
                        'error' => $e
                    ]);
                }
                $user->profile_img = 'guide_profile_'.$email.'.jpg';
                $user->background_img = 'guide_background_'.$email.'.jpg';
                $user->save();

                if(isset($_POST['guideInfo'])){
                    $user->informations = $request->informations;
                    $user->contact = $request->contact;
                    if(isset($request->language)){
                        $allLang = '';
                        foreach($request->language as $lang){
                            $allLang .= ';'.$lang;
                        }
                        $user->language = ltrim($allLang, ';');
                    }
                    $user->dob = $request->year.'-'.$request->month.'-'.$request->day;
                    $user->city = $request->city;
                    $user->country = $request->country;
                    $user->save();
                }
                return redirect()->to('profile/edit/guide')->with('save-message', 'Information saved successfully!');
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

            $allDates = AvailableDates::where(['user_id' => $id])->get();
            $user->availableDates = $allDates;
            $user->packages = packages::where(['agent_id' => $id])->get();
            $user->languages = Languages::all();
            $user->cities = Cities::all();
            $user->countries = Countries::all();

            $allRates = Ratings::where(['agent_id' => $id])->get();
            $total = $finalRate = $count = 0;
            foreach($allRates as $data){
                $total += $data->rating;
                $count++;
            }
            if($total != null){
                $finalRate = $total/$count;
                $user->avgRate = $finalRate;
            }else{
                $user->avgRate = 0;
            }

            $user->header = 'includes.edit-guide-header';
            return view('pages.edit-guide-profile', ['result' => $user]);
        }else{
            return redirect('sign-in/guide');
        }
    }

    public function rateGuide(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if($id == $request->agent_id){
                return redirect()->back()->with('error-message', 'You can\'t rate yourself!');
            }

            $agent = User::find($request->agent_id);
            if($agent->role != 'agent'){
                return redirect()->back()->with('error-message', 'User\'s not an guide!');
            }

            if($request->isMethod('post')){
                if($request->rating == 0){
                    return redirect()->back()->with('error-message', 'Please provide rating!');
                }
                $update_check = Ratings::where('agent_id', $request->agent_id)
                    ->where('user_id', $id)
                    ->get();
                $checker = 0;
                foreach($update_check as $check){
                    $checker = $check->id;
                }
                if($checker != 0){
                    foreach($update_check as $update){
                        $update->rating = $request->rating;
                        $update->comment = $request->comment;
                        $update->save();
                    }
                    return redirect()->back()->with('success-message', 'Rating has been updated!');
                }
                $rate['agent_id'] = $request->agent_id;
                $rate['user_id'] = $id;
                $rate['rating'] = $request->rating;
                $rate['comment'] = $request->comment;
                Ratings::create($rate);
                return redirect()->back()->with('success-message', 'Thanks for the rating!');
            }

        }else{
            return redirect('sign-in/user');
        }
    }

    public function checkGuideReviews($id){
        $user = User::find($id);
        
        if($user->role != 'agent'){
            return redirect()->back()->with('error-message', 'This is not a guide!');
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

        $allComments = Ratings::where('agent_id', $id)->get();
        $user->comments = $allComments;

        $total = $finalRate = $count = 0;
        foreach($allComments as $data){
            $total += $data->rating;
            $count++;
        }
        if($total != null){
            $finalRate = $total/$count;
            $user->avgRate = $finalRate;
        }else{
            $user->avgRate = 0;
        }

        foreach($allComments as $comments){
            $commenter = User::find($comments->user_id);
            $comments->commenter = $commenter->name;
            $c_img = URL::asset('/uploads/'.$commenter->profile_img);
            $imgs = null;
            $comments->profile_img = $c_img;

            if(!@getimagesize($c_img)){
                $imgDir = public_path('/images/random_pp/');
                $imgs = preg_grep('~\.(JPG|jpg|jpeg|png|gif)$~', scandir($imgDir));
                $comments->profile_img = URL::asset('/images/random_pp/'.$imgs[array_rand($imgs)]);
            }
        }

        $user->header = 'includes.agent-profile-header';
        return view('pages.check-guide-reviews', ['result' => $user]);
    }

    public function addAvailabilities(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if ($user->role != 'agent') {
                return redirect()->back();
            }

            if($request->isMethod('post')){
                $dates['user_id'] = $id;
                if($request->date == null){
                    $request->date = date('d-m-Y');
                }
                if($request->time == null){
                    date_default_timezone_set(date_default_timezone_get());
                    $request->time = date('h:i a');
                }
                $dates['available_dates'] = $request->date;
                $dates['available_time'] = $request->time;
                AvailableDates::create($dates);
                return redirect()->back()->with('success-message', 'Date added successfully!');
            }

        }else{
            return redirect('sign-in/guide');
        }
    }

    public function addPackages(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if ($user->role != 'agent') {
                return redirect()->back();
            }

            if($request->isMethod('post')){
                if($request->package_name == null || $request->package_price == null || $request->package_details == null){
                    return redirect()->back()->with('package-error-message', 'Please provide required data!');
                }
                $package['agent_id'] = $id;
                $package['package_name'] = $request->package_name;
                $package['package_price'] = $request->package_price;
                $package['package_details'] = $request->package_details;
                packages::create($package);
                return redirect()->back()->with('package-message', 'Package added successfully!');
            }

        }else{
            return redirect('sign-in/guide');
        }
    }

    public function editAvailabilities(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if ($user->role != 'agent') {
                return redirect()->back();
            }

            if($request->isMethod('post')){
                $date = AvailableDates::find($request->ad_id);
                $date->available_dates = $request->date;
                $date->available_time = $request->time;
                $date->save();
                return redirect()->back()->with('success-message', 'Date updated successfully!');
            }

        }else{
            return redirect('sign-in/guide');
        }
    }

    public function editPackages(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if ($user->role != 'agent') {
                return redirect()->back();
            }

            if($request->isMethod('post')){
                $package = packages::find($request->package_id);
                $package->package_name = $request->package_name;
                $package->package_details = $request->package_details;
                $package->package_price = $request->package_price;
                $package->save();
                return redirect()->back()->with('package-message', 'Package updated successfully!');
            }

        }else{
            return redirect('sign-in/guide');
        }
    }

    public function deleteAvailabilities(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if ($user->role != 'agent') {
                return redirect()->back();
            }

            if($request->isMethod('post')){
                AvailableDates::destroy($request->ad_id);
                return redirect()->back()->with('success-message', 'Date deleted successfully!');
            }

        }else{
            return redirect('sign-in/guide');
        }
    }

    public function deletePackages(Request $request){
        if(Auth::user()) {
            $id = Auth::id();
            $user = User::find($id);

            if ($user->role != 'agent') {
                return redirect()->back();
            }

            if($request->isMethod('post')){
                packages::destroy($request->package_id);
                return redirect()->back()->with('package-message', 'Package deleted successfully!');
            }

        }else{
            return redirect('sign-in/guide');
        }
    }

    public function user_logout(){
        if(Auth::logout());
        return redirect('sign-in/user');
    }
    public function guide_logout(){
        if(Auth::logout());
        return redirect('sign-in/guide');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
