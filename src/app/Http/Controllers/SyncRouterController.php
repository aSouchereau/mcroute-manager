<?php

namespace App\Http\Controllers;



use App\Jobs\SyncDbRouter;
use Illuminate\Http\RedirectResponse;

class SyncRouterController extends Controller
{
    public function sync(): RedirectResponse
    {
        SyncDbRouter::dispatchSync();
        return redirect("routes");
    }
}
