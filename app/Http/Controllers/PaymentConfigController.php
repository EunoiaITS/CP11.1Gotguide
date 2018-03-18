<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentConfig;
use Illuminate\Support\Facades\Response;

class PaymentConfigController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index(){
        $payment = PaymentConfig::all();
        return Response::json([
            'status' => 'true',
            'message' => 'Successfully fetched data!',
            'package' => $payment
        ], 200);
    }

    public function show($id){
        $payment = PaymentConfig::find($id);
        if(!$payment->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'Package does not exist!'
            ], 404);
        }

        return Response::json([
            'status' => 'true',
            'message' => 'Package successfully fetched!',
            'Package' => $payment
        ], 200);
    }

//    public function store(Request $request){
//        if(!$request->agent_id or !$request->package_name or !$request->package_details){
//            return Response::json([
//                'status' => 'false',
//                'message' => 'Provide enough information!'
//            ], 422);
//        }
//
//        $package = packages::create($request->all());
//
//        return Response::json([
//            'status' => 'true',
//            'message' => 'Package successfully added!'
//        ], 201);
//    }
//
//    public function update(Request $request, $id){
//        if(! $request->agent_id or ! $request->package_name or ! $request->package_details){
//            return Response::json([
//                'status' => 'false',
//                'message' => 'Please Provide enough information!'
//            ], 422);
//        }
//
//        $package = packages::find($id);
//        $package->agent_id = $request->agent_id;
//        $package->package_name = $request->package_name;
//        $package->available_date = $request->available_date;
//        $package->save();
//
//        return Response::json([
//            'status' => 'true',
//            'message' => 'Package Updated Successfully!'
//        ], 200);
//    }
//
//    public function destroy($id){
//        packages::destroy($id);
//
//        return Response::json([
//            'status' => 'true',
//            'message' => 'Package deleted successfully!'
//        ], 200);
//    }

}
