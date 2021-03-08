<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::query()->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $userror = [
            'title'=>'required'
        ];
        $ruerror = [
            'title.required'=>'Поле должно быть заполнено'
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();

        Tag::query()->create($request->all());
        $request->session()->flash('success','Тег добавлен');
        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::query()->find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userror = [
            'title'=>'required'
        ];
        $ruerror = [
            'title.required'=>'Поле должно быть заполнено'
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();

        $tag = Tag::query()->find($id);
        $tag->update($request->all());
        $request->session()->flash('success','Изменения сохранены');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::query()->find($id);
        if ($tag->posts->count()){
            return redirect()->route('tags.index')->with('error','Ошибка! У тега есть посты');
        }
        $tag->delete();
        return redirect()->route('tags.index')->with('success','Тег успешно удалена');
    }
}
