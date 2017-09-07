<?php 

if(isset($_GET['logout'])){
    unset($_SESSION['loged']);
}

if(!isset($_SESSION['loged'])) { 
    if(isset($_POST['login']) && $_POST['login'] == 'admin') {
        $_SESSION['loged'] = 1;
        header('Location: /newsTool');
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
        <div class="row">
            <form id="newsform" method="post">
                <input type="text" name="login" />
                <button type="submit" class="btn btn-primary">LogMe</button>
            </form>    
        </div>
    </div>
</body>
</html>
    <?php exit;
}