<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(Request $request) {

    $users = User::all();

    return response()->json(["data" => $users->toArray()]);
});

Route::group(["prefix" => 'users'], function (){
    Route::post('/store', function(Request $request){
        $user = User::create($request->all());
        return response()->json(['data' => $user]);
    });
});
