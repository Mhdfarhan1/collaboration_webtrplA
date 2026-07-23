<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Link;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.custom');

        View::composer(['home', 'partials.navbar'], function ($view) {
            $links = Link::all()->keyBy('link_type');
            $view->with('links', $links);
        });
    }
}

if (!function_exists('encode_id')) {
    function encode_id($id): string {
        return \App\Helpers\SecurityHelper::encode($id);
    }
}

if (!function_exists('decode_id')) {
    function decode_id($encoded) {
        return \App\Helpers\SecurityHelper::decode($encoded);
    }
}
