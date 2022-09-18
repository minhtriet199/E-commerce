<?php
 
namespace App\Http\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Product;
 
class SearchComposer
{ 
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $products = Product::where('name','Like','%'.$data['search'].'%')
                ->orWhere('slug','Like','%'.$data['search'].'%')->get();
    }
}