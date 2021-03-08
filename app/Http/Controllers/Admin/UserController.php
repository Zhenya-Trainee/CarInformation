<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::query()->paginate(10);
        return view('admin.subscriptions.user', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::query()->find($id);
        if ($user->is_admin){
            return redirect()->route('users.index')->with('error','Нельзя удалить администратора');
        } else{
            $user->delete();
        }
        return redirect()->route('users.index')->with('success','Пользователь удален');
    }
}
