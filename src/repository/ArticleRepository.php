<?php
class ArticleRepository {
    
    private $logger;
    
    public function __construct() {
        $this->logger = App::getInstance()->getLogger("ArticleRepository");
    }
    
    public function findAll() {
        try {
            $conn = Db::getConnection();            
            $sql = 'SELECT * FROM articles ORDER BY id DESC';
            $st = $conn->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            $st->closeCursor();
            
            $articles = array();
            foreach ($data as $row) {                
                $articles[] = $this->rawDataToModel($row);
            }
            return $articles;
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            return null;
        }        
    }

    public function findByID($id) {
        try {
            $conn = Db::getConnection();            
            $sql = 'SELECT * FROM articles WHERE id=:id';                                                            
            $st = $conn->prepare($sql);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            $st->closeCursor();
            if (count($data) === 1) {
                return $this->rawDataToModel($data[0]);
            }
            return null;
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            return null;
        }        
    }        
    
    public function insert(Article $article) {
        try {
            $conn = Db::getConnection();            
            $sql = 'INSERT INTO articles 
                        (author, publicationDate, title, summary, content) 
                    VALUES 
                        (:author, :publicationDate, :title, :summary, :content)';                                                            
            $st = $conn->prepare($sql);            
            $st->execute($this->modelToRawData($article));            
            $st->closeCursor();
            
            $this->logger->info("Nuovo articolo inserito: " . $article->getTitle());
            
            return true;
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            return false;
        }        
    }
    
    public function update(Article $article) {
        try {
            $conn = Db::getConnection();            
            $sql = 'UPDATE articles 
                    SET author=:author, title=:title, summary=:summary, content=:content
                    WHERE id=:id';
                        
            $st = $conn->prepare($sql);       
            $st->bindValue(":id", $article->getId(), PDO::PARAM_INT);
            $st->bindValue(":author", $article->getAuthor(), PDO::PARAM_STR);
            $st->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
            $st->bindValue(":summary", $article->getSummary(), PDO::PARAM_STR);
            $st->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
            
            $st->execute();            
            $st->closeCursor();
            
            $this->logger->info("Articolo modificato: " . $article->toString());
            
            return true;
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            return false;
        }        
    }
    
    public function delete($id) {
        try {
            $conn = Db::getConnection();            
            $sql = 'DELETE FROM articles WHERE id=:id';      
            $st = $conn->prepare($sql);            
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();            
            $st->closeCursor();
            
            $this->logger->info("Articolo $id eliminato");
            
            return true;
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            return false;
        }        
    }
            
    private function rawDataToModel($rawData) {
        $article = new Article();
        $article->setId($rawData['id']);
        $article->setAuthor($rawData['author']);
        $article->setPublicationDate($rawData['publicationDate']);
        $article->setTitle($rawData['title']);
        $article->setSummary($rawData['summary']);
        $article->setContent($rawData['content']);
        return $article;
    }
    
    private function modelToRawData(Article $model) {
        return array(
            'author' => $model->getAuthor(),
            'publicationDate' => $model->getPublicationDate() ?: date('Y-m-d'),
            'title' => $model->getTitle(),
            'summary' => $model->getSummary(),
            'content' => $model->getContent()
        );        
    }
    
}