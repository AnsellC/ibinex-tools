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
    <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                    <h1 class="title">Login</h1>
                    <div class="card">
                        
                            <div class="card-content">
                                <div class="content">
                                    <form method="POST" action="/login">
                                        <div class="field">
                                            <p class="control has-icons-left">
                                                <input class="input" type="email" placeholder="Email">
                                                <span class="icon is-small is-left">
                                                <i class="fas fa-envelope"></i>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="field">
                                            <p class="control has-icons-left">
                                                <input class="input" type="password" placeholder="Password">
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