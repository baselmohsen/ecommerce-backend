<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Super Admin override
     */
    public function before(User $user, $ability)
    {
        if ($user->type === 'super_admin') {
            return true;
        }
    }

    /**
     * View all products
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('products.index');
    }

    /**
     * View single product
     */
    public function view(User $user, Product $product)
    {
        return $user->hasPermission('products.index');
    }

    /**
     * Create product
     */
    public function create(User $user)
    {
        return $user->hasPermission('products.create');
    }

    /**
     * Update product
     */
    public function update(User $user, Product $product)
    {
        return $user->hasPermission('products.update');
    }

    /**
     * Delete product
     */
    public function delete(User $user, Product $product)
    {
        return $user->hasPermission('products.delete');
    }

    /**
     * Restore product (لو بتستخدم soft delete)
     */
    public function restore(User $user, Product $product)
    {
        return $user->hasPermission('products.restore');
    }

    /**
     * Force delete product
     */
    public function forceDelete(User $user, Product $product)
    {
        return $user->hasPermission('products.forceDelete');
    }
}