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
        $this->renderAdmin('viewArticles');
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
                    
                } else {
                    
                }                
                break;
            case self::MODE_UPDATE:
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
    
    private function renderAdmin($action = null, $mode = 'insert') {
        $view = new Template();
        $view->title = "Cool CMS - Admin"; 
        $view->mode = $mode;
        if ($action !== null) {
            $view->action = $action;
        } 
        echo $view->render('admin.php');
    }
    
}