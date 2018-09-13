<nav class="navbar navbar-expand-sm navbar-light bg-light mb-3">
        <div class="container">
            {{-- <a class="navbar-brand" href="/"></a> --}}

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item {{ Route::currentRouteName() == 'frontend.home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('frontend.home') }}">
                            <i class="fa fa-home"></i> @lang('gw.home')
                        </a>
                    </li>

                    {{-- <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }} ">
                        <a class="nav-link" href="#">@lang('Εγγραφή ακροατών')</a>
                    </li>
                    
                    <li class="nav-item {{ Route::currentRouteName() == 'frontend.calendar' ? 'active' : '' }}">
                        <a href="{{url('frontend/calendar')}}">
                          <i class="fa fa-calendar"></i>
                          <span class="title"> @lang('Calendar') </span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteName() == 'frontend.papers.index' ? 'active' : '' }}">
                        <a href="{{ route('frontend.papers.index') }}">
                            <i class="fa fa-newspaper-o"></i>
                            <span>@lang('quickadmin.papers.title')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteName() == 'frontend.sessions.index' ? 'active' : '' }}">
                        <a href="{{ route('frontend.sessions.index') }}">
                            <i class="fa fa-clock-o"></i>
                            <span>@lang('quickadmin.sessions.title')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteName() == 'frontend.rooms.index' ? 'active' : '' }}">
                        <a href="{{ route('frontend.rooms.index') }}">
                            <i class="fa fa-map-marker"></i>
                            <span>@lang('quickadmin.rooms.title')</span>
                        </a>
                    </li>


                    <li class="nav-item {{ Route::currentRouteName() == 'frontend.arts.index' ? 'active' : '' }}">
                        <a href="{{ route('frontend.arts.index') }}">
                            <i class="fa fa-paint-brush"></i>
                            <span>@lang('quickadmin.arts.title')</span>
                        </a>
                    </li>     --}}              

                </ul>

                <ul class="navbar-nav ml-auto">

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" >
                                <i class="fa fa-user"></i> {{Auth::user()->name}}
                            </a>
                            <div class="dropdown-menu">

                                @can('backend_access')
                                <a href="{{route('admin.home')}}" class="dropdown-item">
                                    <i class="fa fa-tachometer-alt"></i> @lang('Διαχείριση backend')
                                </a>@endcan

                                <a href="{{route('auth.change_password')}}" class="dropdown-item">
                                    <i class="fa fa-key"></i> @lang('quickadmin.qa_change_password')
                                </a>

                                <a href="#" onclick="$('#logout').submit();" class="dropdown-item">
                                    <i class="fa fa-arrow-left"></i> @lang('quickadmin.qa_logout')
                                </a>

                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{route('login')}}" class="nav-link">
                                <i class="fa fa-sign-in-alt"></i> @lang('Login')
                            </a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>
