<?php
session_start();

require_once('login.php');

require_once('../class/SPDO.php');
require_once('../class/News.php');

if(isset($_POST['news_id'])) {

    $news = new News($_POST['news_id']);
    if(is_null($news->getId())){

        $_SESSION['message']['danger'] = 'Cette news n\'existe pas !';
        header('Location: /newsTool');   
        exit;     
    }
    $news->setTitle($_POST['news_title']);
    $news->setContent($_POST['news_content']);
    $s = isset($_POST['news_status']) ? 1 : 0;    
    $news->setStatus($s);
    $news->saveNewsInfos(); 
    
    $redirect = "/newsTool/app/edit.php?id=".$_POST['news_id'];    
    
} else {
    $news = new News();
    $news->setTitle($_POST['news_title']);
    $news->setContent($_POST['news_content']);
    $s = isset($_POST['news_status']) ? 1 : 0;
    $news->setStatus($s);
    $news->addNews();

    $redirect = "/newsTool";  
}

$_SESSION['message']['success'] = 'Votre news a bien été sauvegardée !';



header('Location: '.$redirect);