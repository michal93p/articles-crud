<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends Seeder
{
    private const USER_NAME_FOR_ADMIN_PANEL = 'Admin';
    private const USER_EMAIL_FOR_ADMIN_PANEL = 'admin@xyz.com';
    private const USER_PASSWORD_FOR_ADMIN_PANEL = 'password';

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createUserForAdminPanel()
            ->createExampleUsers();
    }

    private function createUserForAdminPanel(): self
    {
        User::factory()->create([
            'name' => self::USER_NAME_FOR_ADMIN_PANEL,
            'email' => self::USER_EMAIL_FOR_ADMIN_PANEL,
            'password' => Hash::make(self::USER_PASSWORD_FOR_ADMIN_PANEL),
        ]);

        return $this;
    }

    private function createExampleUsers(): self
    {
        User::factory(9)->create();

        return $this;
    }

}
