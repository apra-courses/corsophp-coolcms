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
                CoolCMS
            </div>

            <!-- sidebar -->
            <div id="sidebar">
                <span class="sidebar-title">Archivio Articoli</span>                                    
                <?php foreach ($this->articles as $article): ?>
                <div class="sidebar-article">
                    <div class="sidebar-article-title">
                        <a href="?action=viewArticle&id=<?=$article->getId()?>"><?=$article->getTitle()?></a>
                    </div>
                    <div class="sidebar-article-summary">
                        (<?=$article->getAuthor()?>, <?=$article->getPublicationDate()?>)
                    </div>
                </div>                    
                <?php endforeach; ?>                    
            </div>

            <!-- content -->
            <div id="content">
                
                <?php if (count($this->articles) > 0): ?>
                
                <div>
                    <span class="content-title">Ultimo articolo</span>                
                    <div class="content-article-title">
                        <?=$this->articles[0]->getTitle()?>
                    </div>
                    <div class="content-article-summary">
                        (<?=$this->articles[0]->getAuthor()?>, <?=$this->articles[0]->getPublicationDate()?>)
                    </div>
                    <div class="sidebar-article-preview">
                        <div><?=$this->articles[0]->getSummary()?></div>                    
                        <a href="?action=viewArticle&id=<?=$this->articles[0]->getId()?>"><span>Leggi intero articolo</span></a>
                    </div>
                </div>
                
                <?php else: ?>
                
                <div>
                    <span class="no-articles">Nessun articolo presente</span>
                </div>
                
                <?php endif; ?>
                
            </div>
                        
        </div>                        
    </body>
</html>
