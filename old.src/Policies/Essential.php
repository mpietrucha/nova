<?php

namespace Mpietrucha\Nova\Policies;

use App\Models\User;
use Laravel\Nova\Resources\Resource;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @extends \Mpietrucha\Nova\Policies\Policy<TModel>
 */
class Essential extends Policy
{
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Laravel\Nova\Resources\Resource<TModel>  $resource
     */
    public function delete(User $user, Resource $resource): bool
    {
        return false;
    }
}
