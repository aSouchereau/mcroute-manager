<?php

namespace App\Http\Controllers\Installer;



use App\Actions\Installer\RouterConnectionChecker;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RouterConnectionController extends Controller
{
    private RouterConnectionChecker $connection;

    public function __construct(RouterConnectionChecker $checker)
    {
        $this->connection = $checker;
    }
    public function view(): Factory|View|Application
    {
        $connection = $this->connection->check();

        return view('installer.router', [
            'errors' => $connection['errors'] ?? null,
        ]);
    }
}
