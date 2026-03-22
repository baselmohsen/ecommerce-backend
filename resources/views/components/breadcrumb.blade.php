<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">{{ $title }}</h1>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="lni lni-home"></i> Home
                        </a>
                    </li>

                    @foreach ($links as $link)
                        <li>
                            @if(isset($link['url']))
                                <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                            @else
                                {{ $link['name'] }}
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
</div>