<?php

namespace App\Policies;

use App\{User, Settings};
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy implements PolicyInterface
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

    public function admin(User $user, Settings $settings)
    {
        return $user->id == $settings->user_id;
    }
}
