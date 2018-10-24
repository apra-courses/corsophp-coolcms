<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$this->title?></title>
        <link rel="icon" href="<?= App::getInstance()->getConfig('ROOT')?>/img/favicon.png" type="image/png" />
        <link rel="stylesheet" href="<?= App::getInstance()->getConfig('ROOT')?>/css/style.css" type="text/css" />
    </head>
    <body>
        <h3>Accesso area amministratore</h3>                
            <form method="POST" action="?action=login">
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
    </body>
</html>
