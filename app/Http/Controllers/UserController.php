<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }


    public function store(Request $request){
        $userror = [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'avatar'=>'nullable|image'
        ];
        $ruerror = [
            'name.required'=>'Заполните ваше Имя',
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'email.unique'=>'Такой Email уже существует',
            'password.required'=>'Заполните поле пароля',
            'password.confirmed'=>'Пароли не совпадают',
            'avatar.image'=>'Выбран неподходящий формат'
        ];

        if ($request->hasFile('avatar')){
            $folder = date('Y-m-d');
            $avatar = $request->file('avatar')->store("images/{$folder}");
        }

        $validator = Validator::make($request->all(),$userror,$ruerror)->validate();

        $user = User::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'avatar' => $avatar,
        ]);
        Mail::to($user)->send(new UserRegistered($user));

        session()->flash('successRegister','Регистрация пройдена. На вашу почту отправлено письмо для подтверждения Email');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){

        $userLogin = new User();
        $userLogin->validateLoginUser($request);

        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ])){
            session()->flash('successAuth', 'Вы успешно авторизовализись');

            if (Auth::user()->is_admin){
                return redirect()->route('admin.index');
            }
            else{
                return redirect()->home();
            }
        }
        return redirect()->back()->with('error','Некорректные данные');
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function confirmEmail(Request $request, $token)
    {
        $user = User::query()->where('token','=',$token)->firstOrFail();
        if ($user->token === $token && $user->verified == true){
            session()->flash('verifiedEmailSuccess', 'Учетная запись уже подтверждена');
            return view('verifiedEmail');
        } elseif ($user->token === $token && $user->verified == false){
            $user->verified = true;
            $user->save();
            session()->flash('verifiedEmailSuccess', 'Учетная запись подтверждена!');
            return view('verifiedEmail');
        }
    }

}
