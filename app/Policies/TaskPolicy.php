<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{ // app/Policies/TaskPolicy.php
    public function updateStatus(User $user, Task $task)
    {
        // Only admin can update status
        return $user->isAdmin();
    }

    public function view(User $user, Task $task)
    {
        // Users can only view their own tasks, admin can view all
        return $user->isAdmin() || $user->id === $task->user_id;
    }
}
