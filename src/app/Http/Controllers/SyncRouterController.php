<?php

namespace App\Http\Controllers;



use App\Jobs\SyncDbRouter;
use Illuminate\Http\RedirectResponse;

class SyncRouterController extends Controller
{
    public function sync(): RedirectResponse
    {
        try {
            SyncDbRouter::dispatchSync();
        } catch (\Exception $e) {
            notyf()->addError('Router API: Failed to sync with router - ' . $e->getMessage());
        }
        return redirect()->back();
    }
}
