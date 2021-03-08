<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Subscriptions extends Model
{
    protected $fillable = [
        'email'
    ];

    public function validateSubscriptionsAndSave($request)
    {
        $userror = [
            'email'=>'required|email|unique:subscriptions'
        ];
        $ruerror = [
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'email.unique'=>'Такой Email уже существует',
        ];
        $validator = Validator::make($request->all(),$userror,$ruerror)->validate();

        Subscriptions::query()->create([
            'email'=>$request->email,
        ]);
    }
    use HasFactory;
}
