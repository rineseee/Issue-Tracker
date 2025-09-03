<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    public function update(User $user, Project $project): bool
    {
        return $project->user_id === $user->id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $project->user_id === $user->id;
    }
}