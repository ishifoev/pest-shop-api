<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if the admin user already exists
        $adminExists = User::where('email', 'admin@buckhill.co.uk')->exists();

        if (!$adminExists) {
            // If the admin user doesn't exist, create it
            $adminUuid = Uuid::uuid4()->toString();

            User::create([
                'uuid' => $adminUuid,
                "name" => "Admin",
                'email' => 'admin@buckhill.co.uk',
                'password' => Hash::make('admin'),
                'first_name' => 'Admin',
                'last_name' => 'Buckhill',
                'is_admin' => true,
                'address' => 'Aini 26 app 7',
                'phone_number' => '908997474',
            ]);
        }
    }
}
