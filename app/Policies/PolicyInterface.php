<?php
/**
 * BasePolicy that implements superuser methods for all the policies
 *
 * @author: Cuesta
 */

namespace App\Policies;
use App\User;

interface PolicyInterface
{
    public function before(User $user, $ability);
    public function super(User $user, $model = null);

}