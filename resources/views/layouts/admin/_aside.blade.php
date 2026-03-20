<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation"></p>
        </div>
    </div>

    

    <ul class="app-menu">

                   
        {{--home--}}
        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{route('admin.dashboard') }}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">{{ trans('home') }}</span></a></li>

                   
        {{--home--}}
        <li><a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}" href="{{route('admin.categories.index') }}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">{{ trans('categories') }}</span></a></li>
        {{--home--}}
        <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}" href="{{route('admin.users.index') }}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">{{ trans('users') }}</span></a></li>


      
        {{--home--}}
        <li><a class="app-menu__item {{ request()->is('*products*') ? 'active' : '' }}" href="{{route('admin.products.index') }}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">{{ trans('products') }}</span></a></li>


      

    

       


       

    </ul>


</aside>
