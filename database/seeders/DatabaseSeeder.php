<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Activity;
use App\Models\ActivityParticipant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Samtest 1',
            'email' => 'samtest1@samtest.com',
            'password' => Hash::make('B0P80$$s3Dob')
        ]);

        User::create([
            'name' => 'Samtest 2',
            'email' => 'samtest2@samtest.com',
            'password' => Hash::make('B0P80$$s3Dob')
        ]);

        Activity::create([
            'code' => '11111',
            'name' => 'First test holiday',
            'description' => 'This is the description for the first holiday',
            'from_date' => '2023-08-08',
            'to_date' => '2023-10-08',
            'user_id' => 1,
        ]);
        ActivityParticipant::create([
            'user_id' => 1,
            'activity_id' => 1,
        ]);
        ActivityParticipant::create([
            'user_id' => 2,
            'activity_id' => 1,
        ]);

        Activity::create([
            'code' => '22222',
            'name' => 'Second test holiday',
            'description' => 'This is the description for the second holiday',
            'from_date' => '2023-09-15',
            'to_date' => '2023-12-08',
            'user_id' => 1,
        ]);
        ActivityParticipant::create([
            'user_id' => 1,
            'activity_id' => 2,
        ]);

        Activity::create([
            'code' => '33333',
            'name' => 'Third test holiday',
            'description' => 'This is the description for the third holiday',
            'from_date' => '2023-09-15',
            'to_date' => '2023-12-08',
            'user_id' => 2,
        ]);
        ActivityParticipant::create([
            'user_id' => 2,
            'activity_id' => 3,
        ]);

        Activity::create([
            'code' => '44444',
            'name' => 'Fourth test holiday',
            'description' => 'This is the description for the fourth holiday',
            'from_date' => '2023-10-15',
            'to_date' => '2024-01-08',
            'user_id' => 1,
        ]);
        ActivityParticipant::create([
            'user_id' => 1,
            'activity_id' => 4,
        ]);
        ActivityParticipant::create([
            'user_id' => 2,
            'activity_id' => 4,
        ]);
    }
}
