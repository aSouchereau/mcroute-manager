<?php

namespace App\Http\Controllers;

use App\Jobs\ResetRouter;
use Illuminate\Http\Request;

class ResetRouterController extends Controller
{
    public function reset() {
        ResetRouter::dispatchSync(true);
    }
}
