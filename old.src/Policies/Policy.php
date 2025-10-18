<?php

namespace Mpietrucha\Nova\Policies;

use App\Models\User;
use Laravel\Nova\Resources\Resource;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 */
class Policy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Laravel\Nova\Resources\Resource<TModel>  $resource
     */
    public function view(User $user, Resource $resource): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Laravel\Nova\Resources\Resource<TModel>  $resource
     */
    public function update(User $user, Resource $resource): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Laravel\Nova\Resources\Resource<TModel>  $resource
     */
    public function delete(User $user, Resource $resource): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Laravel\Nova\Resources\Resource<TModel>  $resource
     */
    public function restore(User $user, Resource $resource): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Laravel\Nova\Resources\Resource<TModel>  $resource
     */
    public function forceDelete(User $user, Resource $resource): bool
    {
        return false;
    }
}
