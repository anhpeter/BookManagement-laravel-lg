<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\FilterBar;
use App\View\Components\Form;
use App\View\Components\ItemActionBar;
use App\View\Components\MailOrderCart;
use App\View\Components\ManagementTable;
use App\View\Components\OrderCart;
use App\View\Components\PageHeading;
use App\View\Components\Pagination;
use App\View\Components\SearchBar;
use App\View\Components\Status;
use Illuminate\Support\Facades\Blade;
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
        //
        Blade::component('alert', Alert::class);
        Blade::component('page-heading', PageHeading::class);
        Blade::component('form', Form::class);
        Blade::component('status', Status::class);
        Blade::component('item-action-bar', ItemActionBar::class);
        Blade::component('management-table', ManagementTable::class);
        Blade::component('search-bar', SearchBar::class);
        Blade::component('filter-bar', FilterBar::class);
        Blade::component('pagination', Pagination::class);
        Blade::component('order-cart', OrderCart::class);
        Blade::component('mail-order-cart', MailOrderCart::class);
    }
}
