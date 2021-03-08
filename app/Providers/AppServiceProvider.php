<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('layouts.sidebar', function ($view){
           $view->with('popular_posts', Post::query()->orderBy('views','desc')->limit(5)->get());
           $view->with('cats', Category::query()->withCount('posts')->orderBy('posts_count','desc')->get());
        });

        view()->composer('admin.index', function ($view){
            $view->with('cats', Category::query()->withCount('posts')->orderBy('posts_count','desc')->paginate(10));
        });

        view()->composer(['layouts.contact_layout','layouts.category_layout','layouts.layout'],function ($view){
            $view->with('recent_posts', Post::query()->orderBy('id','desc')->limit(4)->get());
            $view->with('popular_posts', Post::query()->orderBy('views','desc')->limit(3)->get());
            $view->with('cats', Category::query()->withCount('posts')->orderBy('posts_count','desc')->limit(7)->get());
        });
    }
}

