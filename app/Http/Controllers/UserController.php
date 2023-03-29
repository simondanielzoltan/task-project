<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function search($search) {
        $users = User::where('name','like',"%$search%")->take(10)->get();
        return UserResource::collection($users);
    }
}
