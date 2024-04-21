<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = Group::factory()
            ->has(Route::factory()->count(4))
            ->count(3)
            ->create();

        $routes = Route::factory()
            ->count(5)
            ->create();
    }
}
