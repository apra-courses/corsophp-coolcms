<?php
class FrontendController {
    
    private $articleRepository;
    
    public function __construct() {
        $this->articleRepository = new ArticleRepository();
    }
    
    public function index() {
        $this->renderSite();
    }
    
    public function viewArticle() {
        $id = $_GET['id'];
        $article = $this->articleRepository->findByID($id);
        $this->renderSite($article);
    }
    
    private function renderSite($article = null) {
        $articles = $this->articleRepository->findAll();
        $view = new Template();
        $view->title = "Cool CMS";        
        $view->articles = $articles;
        if ($article !== null) {
            $view->article = $article;
        }
        echo $view->render('site.php');
    }
    
}