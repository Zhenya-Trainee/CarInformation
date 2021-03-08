<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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

        Category::query()->create($request->all());
        $request->session()->flash('success','Категория добавлена');
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::query()->find($id);
        return view('admin.categories.edit', compact('category'));
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

        $category = Category::query()->find($id);
        $category->update($request->all());
        $request->session()->flash('success','Изменения сохранены');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::query()->find($id);
        if ($category->posts->count()){
            return redirect()->route('categories.index')->with('error','Ошибка! У категории есть посты');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success','Категория успешно удалена');
    }
}
