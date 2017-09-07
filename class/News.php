<?php

class News {
    public $pdo;
    
    private $_id;
    private $_title;
    private $_content;
    private $_status; //online / offline
    private $_creation_date;

    public function __construct($id = null) {
        $this->pdo = SPDO::getInstance();
        
        if(!is_null($id)) {       
            $sql = "SELECT * FROM news WHERE news_id = :id";
            $datas = $this->pdo->fetch($sql, array(':id' => $id));
            
            if($datas) {
                $this->_id = $id;
                $this->_title = $datas->news_title;
                $this->_content = $datas->news_content;
                $this->_status = $datas->news_status;
            }
        }
    }

    public function getId() {
        return $this->_id;
    }

    public function setTitle($title) {
        $this->_title = $title;
    }

    public function setContent($content) {
        $this->_content = $content;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }

    public function getNewsInfos() {

        return ['id' => $this->_id
        ,'title' => $this->_title
        ,'content' => $this->_content
        ,'status' => $this->_status
        ,'creation_date' => $this->_creation_date];
    }

    public function saveNewsInfos(){
        if($this->_id) {
            //edit
            $sql = "UPDATE news SET news_title = :title, news_content = :content, news_status = :status WHERE news_id = :id";
            $params = [':id' => $this->_id,':title' => $this->_title, ':content' => $this->_content, ':status' => $this->_status];
            return $this->pdo->query($sql, $params);
        }
        
    }

    public function deleteNews() {
        $sql = "DELETE FROM news WHERE news_id = :id";
        $params = [':id' => $this->_id];
        
        $sql_user_news = 'DELETE FROM user_news WHERE news_id = :id;';
        $this->pdo->fetch($sql_user_news, $params);

        return $this->pdo->query($sql, $params); 
    }

    public function addNews() {
        //add
        $sql = "INSERT INTO news (news_title, news_content, news_status) VALUES (:title , :content, :status);";
        $params = [':title' => $this->_title, ':content' => $this->_content,':status' => $this->_status];
        
        $r = $this->pdo->query($sql, $params);
        var_dump($r);
        
        $this->_id = $this->pdo->lastInsertId();

        return true;
    }

    public function getList() {
        $sql = "SELECT * FROM news";
        $datas = $this->pdo->fetchAll($sql);
        return $datas;
    }

}