<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Habit;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Habit::create([
            'name' => 'Morning Meditation',
            'category' => 'Mindfulness',
            'icon' => '🧘‍♂️',
        ]);
    }
}
