<?php

namespace App\Policies;

use App\Models\OfferedJob;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OfferedJobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function viewAnyEmployer(?User $user){
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, OfferedJob $offeredJob): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        return $user->employer() !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OfferedJob $offeredJob): bool|Response
    {
        if($offeredJob->employer->user_id !== $user->id){
            return false;
        }

        if($offeredJob->jobApplications()->count()>0){
            return Response::deny('Cannot change job with application');
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OfferedJob $offeredJob): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OfferedJob $offeredJob): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OfferedJob $offeredJob): bool
    {
        return false;
    }

    public function apply(User $user, OfferedJob $offeredJob) {
        return !($offeredJob->hasUserApplied($user));
    }
}
