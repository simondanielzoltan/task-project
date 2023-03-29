<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (State::STATUSES as $name) {
            State::updateOrCreate(
                ['name' => $name]
            );
        }
    }
}
