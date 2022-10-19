<?php
 
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CateComposer;
use App\Http\View\Composers\NotificationComposer; 

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('main',CateComposer::class);
        View::composer('admin.users.header',NotificationComposer::class);
    }
}