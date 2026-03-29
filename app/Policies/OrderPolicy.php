<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
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
     * View all orders
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('orders.index');
    }

    /**
     * View single order
     */
    public function view(User $user, Order $order)
    {
        return $user->hasPermission('orders.index');
    }

    /**
     * Create order
     */
    public function create(User $user)
    {
        return $user->hasPermission('orders.create');
    }

    /**
     * Update order
     */
    public function update(User $user, Order $order)
    {
        return $user->hasPermission('orders.update');
    }

    /**
     * Delete order
     */
    public function delete(User $user, Order $order)
    {
        return $user->hasPermission('orders.delete');
    }

    /**
     * Restore order (if using soft deletes)
     */
    public function restore(User $user, Order $order)
    {
        return $user->hasPermission('orders.restore');
    }

    /**
     * Force delete order
     */
    public function forceDelete(User $user, Order $order)
    {
        return $user->hasPermission('orders.forceDelete');
    }
}