<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$this->title?></title>
        <link rel="icon" href="/img/favicon.png" type="image/png" />
        <link rel="stylesheet" href="/css/style.css" type="text/css" />
    </head>
    <body>
        <h3>Accesso area amministratore</h3>                
        <form id="login_form" method="POST" action="/admin?action=login">
            <div id="login_fields">
                <div class="login_row">
                    <span>Username:</span>
                    <input type="text" id="username" name="username">                    
                </div>
                <div class="login_row">
                    <span>Password:</span>
                    <input type="password" id="password" name="password">                    
                </div>
            </div>
            <div id="login_buttons">
                <button type="submit">Login</button>                    
            </div>     

            <?php if (strlen($this->validationMessage) > 0): ?>
            <div class="error-messages">
                <?=$this->validationMessage?>                
            </div>
            <?php endif; ?>                
        </form>
        
        <!-- Placeholder per messaggi di errore -->
        <div id="error_messages"></div>
        
        <!-- Vendor -->
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            accesskey=""crossorigin="anonymous"></script>

        <!-- Script per la gestione delle richieste ajax -->
        <script type="text/javascript" src="/js/coolcms.js"></script>
        <script type="text/javascript" src="/js/login.js"></script>
    </body>
</html>
