<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@vnptgame.vn',
            'password' => Hash::make('vnptg@123456')
        ]);

        $user->assignRole(User::ROLE_SUPER_ADMIN);
    }
}
