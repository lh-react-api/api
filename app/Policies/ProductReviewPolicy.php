<?php

namespace App\Policies;

use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\AdminAuthorities\AdminAuthoritiesAction;

class ProductReviewPolicy extends BasePolicy
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
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProductReview $productReviews)
    {
        $this->byAuthUser($productReviews->user_id);
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, ProductReview $productReviews)
    {
        $this->byAuthUser($productReviews->user_id);
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProductReview $productReviews)
    {
        $this->byAuthUser($productReviews->user_id);
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProductReview $productReviews)
    {
        $this->byAuthUser($productReviews->user_id);
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProductReview $productReviews)
    {
        $this->byAuthUser($productReviews->user_id);
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProductReview $productReviews)
    {
        $this->byAuthUser($productReviews->user_id);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminView(User $user, ProductReview $productReviews)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::READ);
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminCreate(User $user, ProductReview $productReviews)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::CREATE);
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminUpdate(User $user, ProductReview $productReviews)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::UPDATE);
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminDelete(User $user, ProductReview $productReviews)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::DELETE);
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminRestore(User $user, ProductReview $productReviews)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::UPDATE);
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductReview  $productReviews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function adminForceDelete(User $user, ProductReview $productReviews)
    {
        $this->byAdminAuthUser(AdminAuthoritiesAction::DELETE);
        return true;
    }
}
