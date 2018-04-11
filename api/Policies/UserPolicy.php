<?php

namespace Api\Policies;

use Api\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy implements PolicyInterface
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        return $user->isSuperuser();
    }

    public function super(User $user, $model = null)
    {
        return false;
    }

    public function admin(User $user, User $model)
    {
        return $user->id == $model->id;
    }

}
