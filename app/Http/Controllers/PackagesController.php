<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\packages;
use Illuminate\Support\Facades\Response;
use DB;

class PackagesController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index(){
        $packages = packages::all();
        return Response::json([
            'status' => 'true',
            'message' => 'Successfully fetched data!',
            'package' => $packages
        ], 200);
    }

    public function show($id){
        $package = packages::find($id);
        if(!$package){
            return Response::json([
                'status' => 'false',
                'message' => 'Package does not exist!'
            ], 404);
        }

        return Response::json([
            'status' => 'true',
            'message' => 'Package successfully fetched!',
            'Package' => $package
        ], 200);
    }

    public function store(Request $request){
        if(!$request->agent_id or !$request->package_name or !$request->package_details){
            return Response::json([
                'status' => 'false',
                'message' => 'Provide enough information!'
            ], 422);
        }

        $package = packages::create($request->all());

        return Response::json([
            'status' => 'true',
            'message' => 'Package successfully added!'
        ], 201);
    }

    public function update(Request $request, $id){
        if(! $request->agent_id or ! $request->package_name or ! $request->package_details){
            return Response::json([
                'status' => 'false',
                'message' => 'Please Provide enough information!'
            ], 422);
        }

        $package = packages::find($id);
        $package->agent_id = $request->agent_id;
        $package->package_name = $request->package_name;
        $package->package_details = $request->package_details;
        $package->available_date = $request->available_date;
        $package->save();

        return Response::json([
            'status' => 'true',
            'message' => 'Package Updated Successfully!'
        ], 200);
    }

    public function destroy($id){
        packages::destroy($id);

        return Response::json([
            'status' => 'true',
            'message' => 'Package deleted successfully!'
        ], 200);
    }

    public function packageByAgent(Request $request){
        $packages = packages::where('agent_id', $request->agent_id)->get();
        if(!$packages->first()){
            return Response::json([
                'status' => 'false',
                'message' => 'Nothing found!'
            ], 404);
        }
        foreach($packages as $key => $data){

        }
        return Response::json([
            'status' => 'true',
            'message' => 'All packages by the selected agent.',
            'packages' => $packages
        ], 200);
    }

}
