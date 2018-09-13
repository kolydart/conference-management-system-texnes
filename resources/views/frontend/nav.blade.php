<nav class="navbar navbar-expand-sm navbar-dark bg-info mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle"
                        data-toggle="dropdown" id="navbarDropdownMenuLink">Your Ideas</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Ideas</a>
                            <a href="#" class="dropdown-item">Add</a>
                        </div>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a href="#" onclick="$('#logout').submit();" class="nav-link">
                                <i class="fa fa-arrow-left"></i>
                                <span class="title">@lang('quickadmin.qa_logout')</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{route('login')}}" class="nav-link">
                                <i class="fa fa-sign-in-alt"></i>
                                <span class="title">@lang('Login')</span>
                            </a>
                        </li>
                    @endif
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">Register</a>
                        </li> --}}
                </ul>

            </div>
        </div>
    </nav>
