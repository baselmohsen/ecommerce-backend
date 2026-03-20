<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{

    public function before(User $user,$ability){
            if($user->type == 'super_admin'){
                return true;
            }
    }
    /**
     * Display a listing of categories
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('categories.index');
    }

    /**
     * View single category
     */
    public function view(User $user, Category $category)
    {
        return $user->hasPermission('categories.index');
    }

    /**
     * Create category
     */
    public function create(User $user)
    {
        return $user->hasPermission('categories.create');
    }

    /**
     * Update category
     */
    public function update(User $user, Category $category)
    {
        return $user->hasPermission('categories.update');
    }

    /**
     * Delete category
     */
    public function delete(User $user, Category $category)
    {
        return $user->hasPermission('categories.delete');
    }
}