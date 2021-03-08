<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Contact extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message'
    ];

    public function checkValidateContact($request){
        $userror = [
            'name'=>'required',
            'email'=>'required|email|unique:contacts',
            'phone'=>'required',
            'message'=>'required'
        ];
        $ruerror = [
            'name.required'=>'Введите свое Имя',
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'email.unique'=>'Такой Email же существует',
            'phone.required'=>'Вы не указали свой телефон',
            'message.required'=>'Вы не заполнили поле сообщения'

        ];
        $validator = Validator::make($request->all(),$userror,$ruerror)->validate();
    }

    public function saveContact($request){
        $contact = Contact::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ]);
    }

    use HasFactory;
}
