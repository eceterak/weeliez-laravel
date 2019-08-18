<nav id="navbar-top" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="/" class="navbar-brand">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul id="menu-top" class="navbar-nav mr-auto align-items-center">
                <li class="nav-item"><a href="{{ route('motorcycles.index') }}">Motorcycles</a></li>
                <li class="nav-item"><a href="/brand">Brands</a></li>
                <li class="nav-item"><a href="/category">Categories</a></li>
                <li class="nav-item"><a href="/blog">Top</a></li>
                <li class="nav-item"><a href="/article">Blog</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">   
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item">
                    <a href="{{ route('motorcycles.create') }}" class="btn btn-sm btn-secondary">New motorcycle</a>
                </li>
            </ul>
        </div>
    </div>
</nav>