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
    // This will printing data to all the view page being call without call data in controller
    public function boot()
    {
        View::composer('main',CateComposer::class);
        View::composer('admin.users.header',NotificationComposer::class);
    }
}