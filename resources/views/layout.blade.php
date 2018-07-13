<!DOCTYPE html>
<html>          
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ibinex Tools</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    @stack('css')
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<header>
    <nav id="navbar" class="navbar has-shadow is-spaced">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    Ibinex News Tools
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/news">
                        <span class="icon has-text-primary">
                            <i class="fas fa-book"></i>
                        </span>
                        <span>News Tracker</span>
                    </a>
                    <a class="navbar-item" href="/anime">
                        <span class="icon has-text-danger">
                            <i class="fas fa-level-up-alt"></i>
                        </span>
                        <span>SEO Tools</span>
                    </a>
                    <a class="navbar-item" href="/anime">
                        <span class="icon has-text-warning">
                            <i class="fas fa-users"></i>
                        </span>
                        <span>Staff</span>
                    </a>                    
                </div>
                
                <div class="navbar-end">
                        @auth
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                {{ Auth::user()->name }}
                            </a>
                            
                            <div class="navbar-dropdown is-right">
                    
                                <a class="navbar-item" href="/logout">
                                    <span>
                                        <span class="icon has-text-bootstrap">
                                                <i class="fas fa-sign-out-alt"></i>
                                        </span>
                                        <strong>Log Out</strong>

                                    </span>
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>     
        </div>        
    </nav>                       
</header>
<section id="content" class="section">
    <div class="container">
        <div class="columns">
            <div class="column">
                    @if(View::hasSection('title'))
                        <h1 class="title">@yield('title')</h1>
                    @endif
                    <div class="card">
                        <div class="card-content">
                            @include('global.msg')
                            @include('global.error')
                            @yield('content')
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
@stack('scripts')
</body>
</html>