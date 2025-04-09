<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(300)->create();

        $users = User::all()->shuffle();
        for ($i = 0; $i < 20; $i++) {
            \App\Models\Employer::factory()->create([
                'user_id'=> $users->pop()->id
            ]);
        }

        $employers = \App\Models\Employer::all();

        for($i=0;$i<100;$i++){
            \App\Models\OfferedJob::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }
        // User::factory(10)->create();
        foreach($users as $user){
            $jobs = \App\Models\OfferedJob::inRandomOrder()->take(rand(0,4))->get();

            foreach($jobs as $job){
                \App\Models\JobApplication::factory()->create([
                    'offered_job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }

    }
}
