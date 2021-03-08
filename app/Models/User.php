<?php

namespace App\Models;


use App\Mail\UserRegistered;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function validateLoginUser($request)
    {
        $userror = [
            'email'=>'required|email',
            'password'=>'required'
        ];
        $ruerror = [
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'password.required'=>'Заполните поле пароля',
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();
    }


    public function changeUserOptions($request){
        $userId = Auth::user()->id;
        $userName = Auth::user()->name;
        $userEmail = Auth::user()->email;
        $userAvatar = Auth::user()->avatar;

        if ($request->name !== $userName) {
            $request->validate([
                'name'=>'required'
            ]);
            User::query()->find($userId)->update(['name'=>$request->name]);
        }


        if ($request->email !== $userEmail) {
            $request->validate([
                'email'=>'required|email|unique:users'
            ]);
            User::query()->find($userId)->update(['email' => $request->email]);
        }

        if ($request->password !== null) {
            $request->validate([
                'password'=>'confirmed'
            ]);
            User::query()->find($userId)->update(['password' => bcrypt($request->password)]);
        }

        if ($request->avatar !== null){
            $request->validate([
                'avatar'=>'image'
            ]);
            if ($request->hasFile('avatar')){
                $folder = date('Y-m-d');
                $avatar = $request->file('avatar')->store("images/{$folder}");
            }
            User::query()->find($userId)->update(['avatar'=>$avatar]);
        }
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($user){
            $user->token=Str::random(30);
        });
    }
}
