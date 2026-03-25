<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->type }}</p>
        </div>
    </div>

    <ul class="app-menu">

        {{-- Dashboard --}}
        
        <li>
            <a class="app-menu__item {{ request()->is('*dashboard*') ? 'active' : '' }}" 
               href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-tachometer-alt"></i>
                <span class="app-menu__label">{{ trans('dashboard') }}</span>
            </a>
        </li>
    
        @can('viewAny', App\Models\User::class)
        {{-- Categories --}}
        <li>
            <a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}" 
               href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-folder-open"></i>
                <span class="app-menu__label">{{ trans('categories') }}</span>
            </a>
        </li>
        @endcan
        {{-- Products --}}
            <li>
                <a class="app-menu__item {{ request()->is('*products*') ? 'active' : '' }}" 
                href="{{ route('admin.products.index') }}">
                    <i class="app-menu__icon fa fa-boxes"></i>
                    <span class="app-menu__label">{{ trans('products') }}</span>
                </a>
            </li>
        {{-- Products --}}
            <li>
                <a class="app-menu__item {{ request()->is('*orders*') ? 'active' : '' }}" 
                href="{{ route('admin.orders.index') }}">
                    <i class="app-menu__icon fa fa-boxes"></i>
                    <span class="app-menu__label">{{ trans('orders') }}</span>
                </a>
            </li>
        {{-- Users --}}
        <li>
            <a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}" 
               href="{{ route('admin.users.index') }}">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">{{ trans('users') }}</span>
            </a>
        </li>

   
        <li>
            <a class="app-menu__item {{ request()->is('*settings*') ? 'active' : '' }}" 
               href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-settings"></i>
                <span class="app-menu__label">{{ trans('settings') }}</span>
            </a>
        </li>

   

    </ul>
</aside>