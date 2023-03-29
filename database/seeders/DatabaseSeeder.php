<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $counter = 10;
        $tasks = Task::factory($counter)->create();
        $users = User::factory($counter)->create();

        $tasks->each(function ($task) use ($users, $counter) {
            $task->assignedUsers()->attach(
                $users->random(rand(1, $counter))->pluck('id')->toArray()
            );
        });
    }
}
