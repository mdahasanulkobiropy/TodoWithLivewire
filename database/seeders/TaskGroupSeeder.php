<?php

namespace Database\Seeders;

use App\Models\TaskGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskGroup::create([
            'task_gp_name' => 'Urgent Task',
            'is_task_gp_urgent' => 'yes',
        ]);
    }
}
