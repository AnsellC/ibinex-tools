<!DOCTYPE html>
<html>          
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ibinex Tools</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <style type="text/css">
    body {


        height: 100vh;
        background: rgba(12,43,41,1);
        background: -moz-linear-gradient(left, rgba(12,43,41,1) 0%, rgba(21,64,77,1) 100%);
        background: -webkit-gradient(left top, right top, color-stop(0%, rgba(12,43,41,1)), color-stop(100%, rgba(21,64,77,1)));
        background: -webkit-linear-gradient(left, rgba(12,43,41,1) 0%, rgba(21,64,77,1) 100%);
        background: -o-linear-gradient(left, rgba(12,43,41,1) 0%, rgba(21,64,77,1) 100%);
        background: -ms-linear-gradient(left, rgba(12,43,41,1) 0%, rgba(21,64,77,1) 100%);
        background: linear-gradient(to right, rgba(12,43,41,1) 0%, rgba(21,64,77,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0c2b29', endColorstr='#15404d', GradientType=1 );

        }

        h1.title {
        color: #fff;
        }
    </style>
</head>
<body style="padding-top: 5em;">
    <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                    <h1 class="title">Login</h1>
                    <div class="card">
                        
                            <div class="card-content">
                                <div class="content">
                                @include('global.error')
                                    <form method="POST" action="/login">
                                    @csrf
                                        <div class="field">
                                            <p class="control has-icons-left">
                                                <input class="input" name="email" type="email" placeholder="Email">
                                                <span class="icon is-small is-left">
                                                <i class="fas fa-envelope"></i>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="field">
                                            <p class="control has-icons-left">
                                                <input class="input" name="password" type="password" placeholder="Password">
                                                <span class="icon is-small is-left">
                                                <i class="fas fa-key"></i>
                                                </span>
                                            </p>
                                        </div> 
                                        <div class="field">
                                            <p class="control">
                                                <button class="button is-success">
                                                Login
                                                </button>
                                            </p>
                                        </div>                                      
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</body>
</html>