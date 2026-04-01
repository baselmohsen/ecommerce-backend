<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar"
     src="{{ auth()->user()->profile->image_url ?? asset('admin_assets/images/default.png') }}"
     alt="User Image">
        <div>
    <p class="app-sidebar__user-name">
        {{ optional(auth()->user()->profile)->first_name && optional(auth()->user()->profile)->last_name
            ? auth()->user()->profile->first_name . ' ' . auth()->user()->profile->last_name
            : auth()->user()->name }}
    </p>     
   </div>
    </div>

<ul class="app-menu">

    {{-- Dashboard --}}
        @can('dashboard.view')

    <li>
        <a class="app-menu__item {{ request()->is('*dashboard*') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">{{ trans('dashboard') }}</span>
        </a>
    </li>
    @endcan


       <li>
        <a class="app-menu__item {{ request()->is('*profile*') ? 'active' : '' }}"
           href="{{ route('admin.profile') }}">
            <i class="app-menu__icon fa fa-user"></i>
            <span class="app-menu__label">{{ trans('profile') }}</span>
        </a>
    </li>


    {{-- Categories --}}
    @can('viewAny', App\Models\Category::class)
    <li>
        <a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}"
           href="{{ route('admin.categories.index') }}">
            <i class="app-menu__icon fa fa-folder-open"></i>
            <span class="app-menu__label">{{ trans('categories') }}</span>
        </a>
    </li>
    @endcan

    {{-- Products --}}
    @can('viewAny', App\Models\Product::class)
    <li>
        <a class="app-menu__item {{ request()->is('*products*') ? 'active' : '' }}"
           href="{{ route('admin.products.index') }}">
            <i class="app-menu__icon fa fa-bars"></i>
            <span class="app-menu__label">{{ trans('products') }}</span>
        </a>
    </li>
    @endcan

    {{-- Orders --}}
    @can('viewAny', App\Models\Order::class)
    <li>
        <a class="app-menu__item {{ request()->is('*orders*') ? 'active' : '' }}"
           href="{{ route('admin.orders.index') }}">
            <i class="app-menu__icon fa fa-shopping-cart"></i>
            <span class="app-menu__label">{{ trans('orders') }}</span>
        </a>
    </li>
    @endcan

    {{-- Users --}}
    @can('viewAny', App\Models\User::class)
    <li>
        <a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}"
           href="{{ route('admin.users.index') }}">
            <i class="app-menu__icon fa fa-users"></i>
            <span class="app-menu__label">{{ trans('users') }}</span>
        </a>
    </li>
    @endcan

    {{-- Settings --}}
    @can('settings.index')
    <li>
        <a class="app-menu__item {{ request()->is('*settings*') ? 'active' : '' }}"
           href="{{ route('admin.settings') }}">
            <i class="app-menu__icon fa fa-cog"></i>
            <span class="app-menu__label">{{ trans('settings') }}</span>
        </a>
    </li>
    @endcan
 

</ul>
</aside>