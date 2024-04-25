<?php

namespace App\Http\Controllers\Installer;



use App\Actions\Installer\RegisterAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdminRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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

    public function register(RegisterAdminRequest $request)
    {
        $formData = $request->all();

        $response = $this->register->create(
            $formData['name'],
            $formData['email'],
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
