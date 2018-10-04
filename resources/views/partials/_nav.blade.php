 <nav class="navbar navbar-inverse">
          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
              </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="{{Request::is('/') ? "active": ""}}"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                    <li class="{{Request::is('/blog') ? "active": ""}}"><a href="/blog">Blog <span class="sr-only">(current)</span></a></li>
                    <li class="{{Request::is('about') ? "active": ""}}"><a href="/about">About</a></li>
                    <li class="{{Request::is('contact') ? "active": ""}}"><a href="/contact">Contact</a></li>
      
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                 
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->role->name }} <span class="caret"></span>
                        </a>
        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                           <ul>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="{{route('posts.index')}}">Posts</a></li>
                                <li><a href="{{route('categories.index')}}">Categories</a></li>
                                <li><a href="{{route('tags.index')}}">Tags</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/posts">Create Post</a></li>
                              </ul>
                            </li>
                          </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

