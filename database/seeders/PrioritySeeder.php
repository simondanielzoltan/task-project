<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Priority::STATUSES as $name) {
            Priority::updateOrCreate(
                ['name' => $name]
            );
        }
    }
}
