<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function show(){
        return view('user.profile');
    }

    public function update(Request $request){

       $changesWithUserProfile = new User();
       $changesWithUserProfile->changeUserOptions($request);

        session()->flash('successChangeOptions','Изменения сохранены');

        return redirect()->route('user.profile');
    }
}
