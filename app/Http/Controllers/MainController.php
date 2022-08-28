<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Services\Slider\AdminSliderService;

class MainController extends Controller
{
    protected $sliderService;

    public function __construct(AdminSliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Lowkey | Shop bán quần áo',
            'sliders' => $this->sliderService->get()
        ]);
    }
}
