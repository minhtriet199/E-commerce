<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\sendMail;
use Carbon\Carbon;


class JobController extends Controller
{
    public function processQueue()
    {
       sendMail::dispatch()->delay(Carbon::now()->addMinutes(10));
    }
}
