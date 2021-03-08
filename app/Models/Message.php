<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'comment',
        'slug'
    ];
    public function getMessageDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function checkValidateMessage($request)
    {
        $userror = [
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required'
        ];
        $ruerror = [
            'name.required'=>'Введите свое Имя',
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'comment.required'=>'Вы не заполнили поле коментария'

        ];
        $validator = Validator::make($request->all(),$userror,$ruerror)->validate();
    }

    public function saveMessage($request){
        $message = Message::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'comment'=>$request->comment,
            'slug'=>$request->slug
        ]);
    }

    use HasFactory;
}
