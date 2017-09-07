<?php
session_start();

require_once('class/SPDO.php');
require_once('class/News.php');

$redirect = "/newsTool";

if(isset($_GET['id'])) {

    $news = new News($_GET['id']);
    if(is_null($news->getId())){

        $_SESSION['message']['danger'] = 'Cette news n\'existe pas !';
        header('Location: /newsTool');   
        exit;     
    }
    $news->deleteNews();
    
} else {

    $_SESSION['message']['danger'] = 'Cette news n\'existe pas !';
    header('Location: /newsTool');   
    exit; 
} 

header('Location: '.$redirect);