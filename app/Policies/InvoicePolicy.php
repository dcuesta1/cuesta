<?php

namespace Api\Policies;

use Api\{User, Invoice};
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy implements PolicyInterface
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

    public function admin(User $user, Invoice $invoice = null)
    {
        return $user->id === $invoice->user_id;
    }
}
