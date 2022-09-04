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
        $menus = Menus::select('id', 'name','slug')->orderBy('id')->get();
        $view->with('menus', $menus);
    }
}