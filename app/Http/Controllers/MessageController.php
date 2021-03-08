<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{

    public function store(Request $request){
        $actionsWithMessages = new Message();
        $actionsWithMessages->checkValidateMessage($request);
        $actionsWithMessages->saveMessage($request);

        session()->flash('successMessage','Вы оставили коментарий');

        return back();
    }
}
