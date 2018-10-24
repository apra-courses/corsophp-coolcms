<?php
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;

class App {
    
    const DEFAULT_CONTROLLER_ACTION = 'index';
    
    private $config;
    private $pathInfo;
    private $action;        
    
    private function __construct() {  
        $this->readConfig();
        $this->readPathInfo();
        $this->readAction();        
    }
    
    public static function getInstance() {
        static $instance = null;
        if (!$instance) {
            $instance = new App();
        }
        return $instance;
    }
    
    public function getConfig($key, $default = null) {
        return isset($this->config[$key]) ? $this->config[$key] : $default;
    }
    
    public function getPathInfo() {
        return $this->pathInfo;
    }
     
    public function getAction() {        
        return $this->action ?: self::DEFAULT_CONTROLLER_ACTION;
    }
    
    public function getLogger($channelName) {
        $logger = new Logger($channelName);
        $formatter = new LineFormatter(null, null, false, true);
        $handler = new StreamHandler(LOG_DIR . '/app.log', $this->getConfig('LOG_LEVEL'));
        $handler->setFormatter($formatter);
        $logger->pushHandler($handler);
        return $logger;
    }
    
    private function readConfig() {
        $this->config = require_once(CFG_DIR . '/config.php');
    }
    
    private function readPathInfo() {
        $this->pathInfo = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/';        
    }
    
    private function readAction() {
        $this->action = isset($_GET['action']) ? $_GET['action'] : '';
    }
        
    public function getUserProfile($key = null) {
        $userProfile = (isset($_SESSION['userProfile']) ? $_SESSION['userProfile'] : null);
        if ($key === null) {
            return $userProfile;
        }
        if ($userProfile !== null) {
            return $userProfile[$key];
        }
        return null;
    }
    
    public function setUserProfile($userProfile) {
        $_SESSION['userProfile'] = $userProfile;        
    }
    
    public function isUserLoggedIn() {
        $userProfile = $this->getUserProfile();
        return $userProfile !== null;
    }
    
}