<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 parents
        $parents = User::factory()->count(50)->create(['role' => 'Parent']);

        // Create 3 administrators
        $admins = User::factory()->count(3)->create(['role' => 'Administrator']);

        foreach ($parents as $parent) {
            // Randomly determine the number of children for each parent (1 to 3)
            $numberOfChildren = rand(1, 3);

            // Create children for each parent
            $children = Student::factory()->count($numberOfChildren)->create(['user_id' => $parent->id]);
        }

        // Create additional users (if needed)
        User::factory()->count(10)->create();
    }
}

