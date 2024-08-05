<?php

namespace Database\Seeders;

use App\Models\Task;
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
       $user= User::factory(10)->create();
       $user->each(function($user){
        Task::factory()->count(rand(1,4))->create(['user_id'=>$user->id]);
       });
        
    }
}
