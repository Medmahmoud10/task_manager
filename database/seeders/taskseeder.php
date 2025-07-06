<?php

namespace Database\Seeders;

use App\Models\task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class taskseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Complete project report',
                'description' => 'Finish the final report for the project by end of the week.',
                'priority' => 1,
            ],
            [
                'title' => 'Prepare presentation slides',
                'description' => 'Create slides for the upcoming presentation next Monday.',
                'priority' => 2,
            ],
            [
                'title' => 'Update website content',
                'description' => 'Revise the content on the homepage and about page.',
                'priority' => 3,
            ],
            [
                'title' => 'Organize team meeting',
                'description' => 'Schedule and organize a team meeting for project updates.',
                'priority' => 1,
            ],
            [
                'title' => 'Review codebase',
                'description' => 'Go through the codebase and refactor where necessary.',
                'priority' => 2,
            ],
            [
                'title' => 'Respond to client emails',
                'description' => 'Reply to all pending client emails by today.',
                'priority' => 1,
            ],
            [
                'title' => 'Backup database',
                'description' => 'Perform a full backup of the project database.',
                'priority' => 3,
            ],
            [
                'title' => 'Test new features',
                'description' => 'Test the newly implemented features for bugs.',
                'priority' => 2,
            ],
            [
                'title' => 'Update documentation',
                'description' => 'Update the project documentation with recent changes.',
                'priority' => 3,
            ],
            [
                'title' => 'Plan sprint tasks',
                'description' => 'Plan and assign tasks for the next sprint.',
                'priority' => 1,
            ],
        ];

    foreach ($tasks as $task) {
        // Insert the task into the 'tasks' table
        task::create($task);
    }
        
    }
}
