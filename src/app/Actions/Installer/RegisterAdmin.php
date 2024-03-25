<?php

namespace App\Actions\Installer;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAdmin
{
    protected array $results;

    function __construct()
    {
        $this->results['errors'] = null;
    }

    public function create($name, $email, $password): array
    {
        if (!$this->checkAdminExists()) {
            User::create([
                'name'   => $name,
                'email'  => $email,
                'password' => Hash::make($password),
                'role' => 'admin'
            ]);
        } else {
            $this->results['errors'] = "Could not create admin account.";
        }
        return $this->results;
    }

    private function checkAdminExists(): bool
    {
        if (User::query()->where('role', '=', 'admin')->first()) {
            return true;
        }

        return false;
    }
}
