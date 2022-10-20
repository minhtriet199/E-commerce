<?php
 
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Notification;
 
class NotificationComposer
{ 
    
    public function __construct(){
    }

    public function compose(View $view)
    {
        $notification = Notification::orderBy('created_at','desc')
        ->get();
        $all = Notification::where('active',0)
        ->get();
        $view->with('notify',$notification)->with('all',$all);
    }
}