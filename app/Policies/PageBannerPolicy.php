<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PageBanner;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageBannerPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PageBanner');
    }

    public function view(AuthUser $authUser, PageBanner $pageBanner): bool
    {
        return $authUser->can('View:PageBanner');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PageBanner');
    }

    public function update(AuthUser $authUser, PageBanner $pageBanner): bool
    {
        return $authUser->can('Update:PageBanner');
    }

    public function delete(AuthUser $authUser, PageBanner $pageBanner): bool
    {
        return $authUser->can('Delete:PageBanner');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PageBanner');
    }

    public function restore(AuthUser $authUser, PageBanner $pageBanner): bool
    {
        return $authUser->can('Restore:PageBanner');
    }

    public function forceDelete(AuthUser $authUser, PageBanner $pageBanner): bool
    {
        return $authUser->can('ForceDelete:PageBanner');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PageBanner');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PageBanner');
    }

    public function replicate(AuthUser $authUser, PageBanner $pageBanner): bool
    {
        return $authUser->can('Replicate:PageBanner');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PageBanner');
    }

}