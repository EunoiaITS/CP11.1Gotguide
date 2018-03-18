<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPayments;
use Illuminate\Support\Facades\Response;
use App\User;

class UserPaymentsController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index(){
        $payments = UserPayments::all();
        return Response::json([
            'status' => 'true',
            'message' => 'Successfully fetched data!',
            'payment' => $payments
        ], 200);
    }

    public function show($id){
        $payment = UserPayments::find($id);
        if(!$payment->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'Payment does not exist!'
            ], 404);
        }

        return Response::json([
            'status' => 'true',
            'message' => 'Payment successfully fetched!',
            'payment' => $payment
        ], 200);
    }

    public function store(Request $request){
        if(!$request->user_id or !$request->amount or !$request->payment_type or !$request->payment_status or !$request->payment_expiry){
            return Response::json([
                'status' => 'false',
                'message' => 'Provide enough information!'
            ], 422);
        }

        UserPayments::where('user_id', $request->user_id)
            ->delete();

        $request->payment_time = time();

        UserPayments::create($request->all());
        if($request->payment_status == 'paid'){
            User::where('id', $request->user_id)
                ->update(['payment_status' => 'paid']);
        }

        return Response::json([
            'status' => 'true',
            'message' => 'Payment successfully added!'
        ], 201);
    }

    public function update(Request $request, $id){
        if(!$request->user_id or !$request->amount or !$request->payment_type or !$request->payment_time or !$request->payment_status or !$request->payment_expiry){
            return Response::json([
                'status' => 'false',
                'message' => 'Please Provide enough information!'
            ], 422);
        }

        $payment = UserPayments::find($id);
        $payment->user_id = $request->user_id;
        $payment->payment_id = $request->payment_id;
        $payment->payment_amount = $request->amount;
        $payment->payment_type = $request->payment_type;
        $payment->payment_time = $request->payment_time;
        $payment->payment_status = $request->payment_status;
        $payment->payment_expiry = $request->payment_expiry;
        $payment->save();

        return Response::json([
            'status' => 'true',
            'message' => 'Payment Updated Successfully!'
        ], 200);
    }

    public function destroy($id){
        UserPayments::destroy($id);

        return Response::json([
            'status' => 'true',
            'message' => 'Payment deleted successfully!'
        ], 200);
    }

    public function paymentByAgent(Request $request){
        $payment = UserPayments::where('user_id', $request->user_id)->get();
        if(!$payment->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'Nothing found!'
            ], 404);
        }
        return Response::json([
            'status' => 'true',
            'message' => 'All Payments by the selected agent.',
            'payments' => $payment
        ], 200);
    }
}
