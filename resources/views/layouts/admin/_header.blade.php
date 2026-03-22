<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" style="font-family: 'Cairo', 'sans-serif';" href="">Vali</a>

    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">
  {{-- Language Selector --}}
            <li class="nav-item dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications" style="position:relative;">
                            <i class="fa fa-flag"></i>{{ strtoupper(app()->getLocale()) }}
                        </a>


                <div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="languageDropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </li>
        {{--notification--}}
       <li class="dropdown" id="notifications">
    <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications" style="position:relative;">
        <i class="fa fa-bell-o fa-lg"></i>
        <span class="badge badge-danger" id="unread-notifications-count" style="position:absolute; top: 10px; right: 5px;">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    </a>

    <ul class="app-notification dropdown-menu dropdown-menu-right">
        <div class="app-notification__content">
            @forelse(auth()->user()->unreadNotifications as $notification)
                <li>
                    <a class="app-notification__item d-flex align-items-start" href="{{ route('admin.orders.show', $notification->data['order_id']) }}">
                        <span class="app-notification__icon me-2">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-address-book fa-stack-1x fa-inverse"></i>
                            </span>
                        </span>
                        <div>
                            <p class="app-notification__message">{{ $notification->data['message'] }}</p>
                            <p class="app-notification__meta">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                </li>
            @empty
                <li>
                    <span class="dropdown-item">No new notifications</span>
                </li>
            @endforelse
        </div>

        <li class="app-notification__footer">
            <a href="{{ route('admin.notifications') }}">View all notifications</a>
        </li>
    </ul>
</li>
       
        {{--user menu--}}
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="page-login.html" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>
                        @lang('site.logout')
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </li>

  
        </ul>
        </li>
        


    </ul>
</header>