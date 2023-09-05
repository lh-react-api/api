<?php

namespace App\Policies;

use App\Models\RecommendProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\AdminAuthorities\AdminAuthoritiesAction;

class RecommendProductPolicy extends BasePolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAuthUser($recommendProduct->user_id);
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAuthUser($recommendProduct->user_id);
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAuthUser($user->id);
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAuthUser($user->id);
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAuthUser($user->id);
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAuthUser($recommendProduct->user_id);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminView(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::READ);
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminCreate(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::CREATE);
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminUpdate(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::UPDATE);
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminDelete(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::DELETE);
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminRestore(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::UPDATE);
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecommendProduct  $recommendProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminForceDelete(User $user, RecommendProduct $recommendProduct)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::DELETE);
        return true;
    }
}
