<?php

namespace App\Policies;

use App\Models\Mark;
use App\Models\User;
use App\Models\SchoolClass; // Added
use Illuminate\Auth\Access\Response;

class MarkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Any authenticated user (teacher) can access the marks listing page.
        // The actual filtering of marks will be done in the controller.
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mark $mark): bool
    {
        // Allow if user created the mark OR if the mark's class is one of the user's classes.
        if ($mark->user_id === $user->id) {
            return true;
        }
        return $user->schoolClasses()->where('school_classes.id', $mark->school_class_id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, ?SchoolClass $schoolClass = null): bool
    {
        // If schoolClass is not passed directly (e.g., from controller $this->authorize('create', Mark::class))
        // then this policy cannot make a decision based on the class.
        // It's better to pass the $schoolClass instance to the policy method.
        // The controller should fetch it based on request input and pass it.
        if (!$schoolClass) {
             // Fallback or default policy if no class context is given.
             // Depending on requirements, could deny or allow if user is e.g. an admin.
             // For now, if no class provided, deny.
            return false;
        }
        // Check if the user is a teacher of the selected class.
        return $user->schoolClasses()->where('school_classes.id', $schoolClass->id)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mark $mark): bool
    {
        // Example: Only teacher who created the mark can update it.
        // return $mark->user_id === $user->id;
        return false; // Not implemented yet
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mark $mark): bool
    {
        // Example: Only teacher who created the mark or is admin for the class can delete.
        // if ($mark->user_id === $user->id) return true;
        // return $user->schoolClasses()->where('school_classes.id', $mark->school_class_id)->exists(); // Simplified
        return false; // Not implemented yet
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mark $mark): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mark $mark): bool
    {
        return false;
    }
}
