<?php

namespace App\Policies;

use App\Models\DeliverTime;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\AdminAuthorities\AdminAuthoritiesAction;

class DeliverTimePolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     * 
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeliverTime  $deliverTime
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminView(User $user, DeliverTime $deliverTime)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::READ);
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeliverTime  $deliverTime
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminCreate(User $user, DeliverTime $deliverTime)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::CREATE);
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeliverTime  $deliverTime
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminUpdate(User $user, DeliverTime $deliverTime)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::UPDATE);
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeliverTime  $deliverTime
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminDelete(User $user, DeliverTime $deliverTime)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::DELETE);
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeliverTime  $deliverTime
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminRestore(User $user, DeliverTime $deliverTime)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::UPDATE);
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeliverTime  $deliverTime
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminForceDelete(User $user, DeliverTime $deliverTime)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::DELETE);
        return true;
    }
}
