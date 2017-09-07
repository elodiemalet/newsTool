<?php
session_start();

require_once('login.php');

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

$title = 'Ajouter une news';
$newsinfos = array();
if(isset( $_GET['id'])){
    $title = 'Editer une news';
    $id = $_GET['id'];  
    $news = new News($id);
    $newsinfos = $news->getNewsInfos(); 
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
        <h3><?php echo $title; ?></h3>
        <hr></hr>
        <?php echo $success; ?>
        <div class="row">  
            <div class="col-12">
                <form id="newsform" method="post" action="save.php">
                    <?php if(isset( $id )){ ?>
                    <input type="hidden" id="id" name="news_id" value="<?php echo $id; ?>" />
                    <?php } ?>
                    
                    <div class="form-group">
                    <label for="news_title">Title</label>
                    <input type="text" class="form-control" value="<?php echo isset($newsinfos['title']) ? $newsinfos['title'] : ''; ?>" id="news_title" name="news_title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                    <label for="news_content">Content</label>
                    <textarea class="form-control" id="news_content" name="news_content" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="news_status">Publier</label>
                    <input type="checkbox" name="news_status" id="status" value="1" <?php echo isset($newsinfos['status']) && $newsinfos['status'] ? 'checked' : ''; ?>>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button> 
                </form>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace( 'news_content' );

        var txt = "<?php echo isset($newsinfos['content']) ? str_replace("\r\n", "",$newsinfos['content']) : ''; ?>";
        CKEDITOR.instances['news_content'].setData(txt);
    </script>
    
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    "use strict";
    window.addEventListener("load", function() {
        var form = document.getElementById("newsform");
        form.addEventListener("submit", function(event) {
        if (form.checkValidity() == false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add("was-validated");
        }, false);
    }, false);
    }());
    
    </script>
</body>
</html>