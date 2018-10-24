<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$this->title?></title>
        <link rel="icon" href="<?= App::getInstance()->getConfig('ROOT')?>/img/favicon.png" type="image/png" />
        <link rel="stylesheet" href="<?= App::getInstance()->getConfig('ROOT')?>/css/style.css" type="text/css" />
    </head>
    <body>
        <!-- container -->
        <div id="container">
            
            <!-- header -->
            <div id="header">
                CoolCMS - Area amministratore
            </div>

            <!-- sidebar -->
            <div id="sidebar">
                
                <div id="user_profile">
                    Benvenuto <b><?=App::getInstance()->getUserProfile('username') ?></b>
                    <br>
                    <a href="?action=logout">Logout</a>
                </div>
                
                <br>
                
                <div id="sidebar_admin_actions">
                    <span class="sidebar-title">Azioni</span>
                    <ul>
                        <li><a href="?action=newArticle">Nuovo articolo</a></li>
                        <li><a href="?action=viewArticles">Gestione articoli</a></li>
                    </ul>
                </div>
                
            </div>

            <!-- content -->
            <div id="content">       
                <?php if ($this->action === 'newArticle' || $this->action === 'editArticle'): ?>
                    <?php include(VIEW_DIR . '/admin/article.php'); ?>
                <?php elseif ($this->action === 'viewArticles'): ?>
                    <?php include(VIEW_DIR . '/admin/articles.php'); ?>
                <?php else: ?>               
                    <?php include(VIEW_DIR . '/admin/default.php'); ?>
                <?php endif; ?>
            </div>
                        
        </div>                        
    </body>
</html>
