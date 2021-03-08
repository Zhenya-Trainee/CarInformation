<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        $subs = Subscriptions::query()->paginate(10);
        return view('admin.subscriptions.subscription', compact('subs'));
    }

    public function destroy($id)
    {
        $sub = Subscriptions::query()->find($id);
        $sub->delete();
        return redirect()->route('subscriptions.index')->with('success','Подписчик удален');
    }
}
