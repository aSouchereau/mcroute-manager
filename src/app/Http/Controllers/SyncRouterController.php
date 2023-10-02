<?php

namespace App\Http\Controllers;



use App\Jobs\SyncDbRouter;

class SyncRouterController extends Controller
{
    public function __invoke(): void
    {
        SyncDbRouter::dispatchSync();
    }
}
