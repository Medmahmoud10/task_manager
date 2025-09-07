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
        'id' => 1,
        'title' => 'Complete project report',
        'description' => 'Finish the final report for the project by end of the week.',
        'priority' => 1,
        'user_id' => 1,
        'categorie_id' => 1,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 2,
        'title' => 'Update website content',
        'description' => 'Revise the content on the homepage and about page.',
        'priority' => 3,
        'user_id' => 1,
        'categorie_id' => 2,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 3,
        'title' => 'Organize team meeting',
        'description' => 'Schedule and organize a team meeting for project updates.',
        'priority' => 1,
        'user_id' => 2,
        'categorie_id' => 3,
        'profile_id' => 2,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 4,
        'title' => 'Review codebase',
        'description' => 'Go through the codebase and refactor where necessary.',
        'priority' => 2,
        'user_id' => 1,
        'categorie_id' => 4,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 5,
        'title' => 'Respond to client emails',
        'description' => 'Reply to all pending client emails by today.',
        'priority' => 1,
        'user_id' => 1,
        'categorie_id' => 5,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 6,
        'title' => 'Backup database',
        'description' => 'Perform a full backup of the project database.',
        'priority' => 3,
        'user_id' => 2,
        'categorie_id' => 6,
        'profile_id' => 2,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 7,
        'title' => 'Test new features',
        'description' => 'Test the newly implemented features for bugs.',
        'priority' => 2,
        'user_id' => 1,
        'categorie_id' => 7,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 8,
        'title' => 'Fix critical bug',
        'description' => 'Address the critical bug reported by the QA team.',
        'priority' => 1,
        'user_id' => 2,
        'categorie_id' => 8,
        'profile_id' => 2,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 9,
        'title' => 'Update project timeline',
        'description' => 'Update the project timeline with new milestones.',
        'priority' => 2,
        'user_id' => 1,
        'categorie_id' => 9,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 10,
        'title' => 'Update documentation',
        'description' => 'Update the project documentation with recent changes.',
        'priority' => 3,
        'user_id' => 2,
        'categorie_id' => 10,
        'profile_id' => 2,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 11,
        'title' => 'Plan sprint tasks',
        'description' => 'Plan and assign tasks for the next sprint.',
        'priority' => 1,
        'user_id' => 1,
        'categorie_id' => 11,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 12,
        'title' => 'Conduct user testing',
        'description' => 'Conduct user testing sessions to gather feedback.',
        'priority' => 2,
        'user_id' => 2,
        'categorie_id' => 12,
        'profile_id' => 2,
        'updated_at' => now(),
        'created_at' => now(),
    ],
    [
        'id' => 13,
        'title' => 'Prepare budget report',
        'description' => 'Prepare the budget report for the last quarter.',
        'priority' => 3,
        'user_id' => 1,
        'categorie_id' => 13,
        'profile_id' => 1,
        'updated_at' => now(),
        'created_at' => now(),
    ],
];

        foreach ($tasks as $task) {
            // Insert the task into the 'tasks' table
            task::create($task);
        }
    }
}
