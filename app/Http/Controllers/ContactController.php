<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show(){
        return view('contact.contact');
    }

    public function store(Request $request){

        $actionsWithContact = new Contact();
        $actionsWithContact->checkValidateContact($request);
        $actionsWithContact->saveContact($request);

        session()->flash('successmessage','Ваше сообщение успешно отправлено');

        return redirect()->route('contacts.single');
    }
}
