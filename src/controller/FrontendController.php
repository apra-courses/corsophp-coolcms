<?php
require_once SRC_DIR . '/template.php';
require_once REPOSITORY_DIR . '/ArticleRepository.php';

class FrontendController {
    
    private $articleRepository;
    
    public function __construct() {
        $this->articleRepository = new ArticleRepository();
    }
    
    public function index() {
        $articles = $this->articleRepository->findAll();
        $view = new Template();
        $view->title = "Cool CMS";        
        $view->articles = $articles;
        echo $view->render('site.php');
    }
    
    public function viewArticle() {
        $id = $_GET['id'];
        echo $id;
    }
    
}