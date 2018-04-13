<?php

namespace Api\Policies;

use Api\User;
use Api\Car;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy implements PolicyInterface
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user->isSuperuser()) {
            return true;
        }
    }

    public function super(User $user, $model = null)
    {
        return false;
    }


    public function admin(User $user, Car $model = null)
    {
        $customer = $model->customer;

        return $customer->user_id === $user->id;
    }
}
