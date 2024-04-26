<?php

namespace App\Http\Controllers\Installer;



use App\Actions\Installer\RegisterAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdminRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class RegisterAdminController extends Controller
{
    private RegisterAdmin $register;

    function __construct(RegisterAdmin $registerAdmin)
    {
        $this->register = $registerAdmin;
    }
    public function view(): Factory|View|Application
    {
        return view('installer.register');
    }

    public function register(RegisterAdminRequest $request): Redirector|Application|RedirectResponse
    {
        $formData = $request->all();

        $response = $this->register->create(
            $formData['username'],
            $formData['password'],
        );

        if (empty($response['errors'])) {
            return redirect('install/success');
        } else {
            notyf()->addError($response['errors']);
            return back()->with('action-error', $response['errors']);
        }
    }



}
