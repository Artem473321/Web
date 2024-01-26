<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleStoreRequest;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function index(){
        $users = People::all();

        return response()->json([
            'results' => $users
        ], 200);
    }

    public function store(PeopleStoreRequest $request)
    {

        try {

            DB::table('people')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);

            // Return Json Response
            return response()->json([
                'message' => "User successfully created."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }

    public function show($id)
    {
        // User Detail
        $users = DB::table('people')->find($id);
        if(!$users){
            return response()->json([
                'message'=>'User Not Found.'
            ],404);
        }

        // Return Json Response
        return response()->json([
            'users' => $users
        ],200);
    }

    public function update(PeopleStoreRequest $request, $id)
    {
        try {
            // Find User
            $users = People::find($id);
            if(!$users){
                return $users()->json([
                    'message'=>'User Not Found.'
                ],404);
            }

            //echo "request : $request->image";
            $users->name = $request->name;
            $users->email = $request->email;
            $users->message = $request->message;

            // Update User
            $users->save();

            // Return Json Response
            return response()->json([
                'message' => "User successfully updated."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }

    public function destroy($id)
    {
        // Detail
        $users = People::find($id);
        if(!$users){
            return response()->json([
                'message'=>'User Not Found.'
            ],404);
        }

        // Delete User
        $users->delete();

        // Return Json Response
        return response()->json([
            'message' => "User successfully deleted."
        ],200);
    }

}
