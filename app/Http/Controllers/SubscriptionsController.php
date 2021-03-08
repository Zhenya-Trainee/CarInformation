<?php

namespace App\Http\Controllers;


use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionsController extends Controller
{

    public function store(Request $request){

        $subscriptions = new Subscriptions();
        $subscriptions->validateSubscriptionsAndSave($request);

        session()->flash('success','Вы подписались на обновления');

        return redirect()->home();
    }


}
