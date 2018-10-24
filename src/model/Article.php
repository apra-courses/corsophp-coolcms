<?php
 
class Article {
    private $id;
    private $author;
    private $publicationDate;
    private $title;
    private $summary;
    private $content;
    
    public function __construct() {        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPublicationDate() {
        return $this->publicationDate;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function getContent() {
        return $this->content;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function setContent($content) {
        $this->content = $content;
    }

}