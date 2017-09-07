<?php
session_start();

require_once('app/login.php');

require_once('class/SPDO.php');
require_once('class/News.php');

$success = "";
if(isset($_SESSION['message'])) {
    foreach($_SESSION['message'] as $k => $m) {

        $success = '<div class="alert alert-'.$k.'" role="alert">
        '.$m.'
        </div>';
    }
    unset($_SESSION['message']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News tool</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ckeditor/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <h1>Outil de gestion des news</h1>
        <?php include_once('components/nav.php'); ?>
        <?php echo $success; ?>
        <table class="table">
        <?php 
            $news = new News();
            $news_list = $news->getList();
            foreach($news_list as $n) { ?>
                <tr>
                    <td width="75%"><?php echo $n['news_title']; ?></td>
                    <td><a href="/newsTool/app/edit.php?id=<?php echo $n['news_id']; ?>">Edit</a>
                    <td><a href="/newsTool/app/delete.php?id=<?php echo $n['news_id']; ?>">Del</a></td>
                    <td><?php echo $n['news_status'] ? 'Online' : 'Offline'; ?></td>
                    </tr>
            <?php } ?>        
       </table>
    </div>
</body>
</html>