<?php
 
namespace App\Http\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Menus;
 
class CateComposer
{ 
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $menus = Menus::select('id', 'name', 'parent_id','slug')->where('parent_id','>', 1)->orderBy('id')->get();
        $view->with('menus', $menus);
    }
}