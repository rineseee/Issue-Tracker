<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Issue;

class IssuePolicy
{

    public function update(User $user, Issue $issue): bool
    {
        return $user->is_admin || $issue->users->contains($user->id);
    }

    public function delete(User $user, Issue $issue): bool
    {
        return $user->is_admin || $issue->users->contains($user->id);
    }
}
