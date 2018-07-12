<!DOCTYPE html>
<html>          
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ibinex Tools</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
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
            </div>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/anime">
                        <span class="icon has-text-primary">
                            <i class="fas fa-book"></i>
                        </span>
                        <span>News Tracker</span>
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
                    @else
                        <a class="navbar-item" href="/register">
                            <span class="icon has-text-primary"><i class="fas fa-user-plus"></i></span>
                            <span>Register</span>
                        </a>
                        <a class="navbar-item" href="/login">
                            <span class="icon has-text-danger"><i class="fas fa-sign-in-alt"></i></span>
                            <span>Login</span>
                        </a>

                    @endauth
                </div>
            </div>     
        </div>        
    </nav>                       
</header>
    <div class="container">
        <div class="columns">
            <div class="column">
                    <div class="card">
                        
                            <div class="card-content">
                                @yield('content')
                            </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>