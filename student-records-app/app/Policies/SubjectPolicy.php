<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool 
    { 
        return true; 
    } // All teachers can see list of subjects

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Subject $subject): bool 
    { 
        return true; 
    } // All teachers can view a subject

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool 
    { 
        return false; 
    } // Placeholder: Only admins later

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Subject $subject): bool 
    { 
        return false; 
    } // Placeholder: Only admins later

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Subject $subject): bool 
    { 
        return false; 
    } // Placeholder: Only admins later
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Subject $subject): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Subject $subject): bool
    {
        return false;
    }
}
