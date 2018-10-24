<?php
class BackendController {
    
    const MODE_INSERT = 'insert';
    const MODE_UPDATE = 'update';
    
    private $articleRepository;
    
    public function __construct() {
        $this->articleRepository = new ArticleRepository();
    }
    
    public function index() {             
        if (App::getInstance()->isUserLoggedIn()) {
            $this->renderAdmin();
        } else {
            $this->renderLogin();
        }                
    }            
    
    public function login() {
        
        // Filter $_POST: prevent XSS
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $view = new Template();
        
        $loginResult = $this->validateLogin($username, $password);
        if ($loginResult['EXITCODE'] !== 0) {                                            
            $this->renderLogin($loginResult['ERRORMSG']);
        } else {
            // Salva profilo utente in sessione passando per il singleton App
            $userProfile = array(
                'username' => $username,
                'role' => 'admin'
            );
            App::getInstance()->setUserProfile($userProfile);
            
            $this->renderAdmin();
        }        
    }
    
    public function logout() {
        session_destroy();
        $this->renderLogin();
    }
    
    public function newArticle() {
        $this->renderAdmin('newArticle', self::MODE_INSERT);
    }
    
    public function viewArticles() {
        $articles = $this->articleRepository->findAll();
        $this->renderAdmin('viewArticles', null, $articles);
    }
    
    public function editArticle() {
        $id = $_GET['id'];
        $article = $this->articleRepository->findByID($id);
        $this->renderAdmin('newArticle', self::MODE_UPDATE, null, $article);
    }
    
    public function deleteArticle() {
        $id = $_GET['id'];
        if ($this->articleRepository->delete($id)) {
            // TODO
        } else {
            // TODO
        }
    }
    
    public function confirmArticle() {
        $article = new Article();
        $article->setAuthor($_POST['author']);
        $article->setTitle($_POST['title']);
        $article->setSummary($_POST['summary']);
        $article->setContent($_POST['content']);
        
        switch ($_POST['mode']) {
            case self::MODE_INSERT:
                $article->setPublicationDate(null);
                if ($this->articleRepository->insert($article)) {
                    // TODO
                } else {
                    // TODO
                }                
                break;
            case self::MODE_UPDATE:
                $article->setId($_POST['id']);
                if ($this->articleRepository->update($article)) {
                    // TODO
                } else {
                    // TODO
                }      
                break;
        }
    }
    
    private function validateLogin($username, $password) {
        $toReturn = array(
            'EXITCODE' => 0,
            'ERRORMSG' => ''
        );
        
        if ($username !== App::getInstance()->getConfig('ADMIN_USERNAME')) {
            $toReturn['EXITCODE'] = 1;
            $toReturn['ERRORMSG'] = 'Nome utente errato';
            return $toReturn;
        }
        
        if ($password !== App::getInstance()->getConfig('ADMIN_PASSWORD')) {
            $toReturn['EXITCODE'] = 2;
            $toReturn['ERRORMSG'] = 'Password errata';
            return $toReturn;
        }
        
        return $toReturn;
    }
     
    private function renderLogin($validationMessage = null) {
        $view = new Template();
        $view->title = "Cool CMS"; 
        if ($validationMessage !== null) {
            $view->validationMessage = $validationMessage;
        }        
        echo $view->render('login.php');
    }
    
    private function renderAdmin($action = null, $mode = null, $articles = null, $article = null) {
        $view = new Template();
        $view->title = "Cool CMS - Admin"; 
        if ($mode !== null) {
            $view->mode = $mode;
        }        
        if ($action !== null) {
            $view->action = $action;
        } 
        if ($articles !== null) {
            $view->articles = $articles;
        }
        if ($article !== null) {
            $view->article = $article;
        }
        echo $view->render('admin.php');
    }
    
}