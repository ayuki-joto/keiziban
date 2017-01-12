<?php
require_once 'dbmanage.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $db = new dbmanage();
    if ($_POST['name'] == null){
        header('Location: index.php');
        exit();
    }
    elseif (mb_strlen($_POST['name'])>20){
        header('Location: index.php');
        exit();
    }
    else{
        $name = htmlspecialchars($_POST['name']);
    }

    if ($_POST['text'] == null){
        header('Location: index.php');
        exit();
    }
    elseif (mb_strlen($_POST['text'])>140){
        header('Location: index.php');
        exit();
    }
    else {
        $text = htmlspecialchars($_POST['text']);
    }

    $db->post($name,$text);

}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="css/validationEngine.jquery.css">
    <title>掲示板</title>
    <script>
        $(function(){
            jQuery("#form").validationEngine();
        });
    </script>
</head>
<body style="text-align: center">
<h1 style="text-align: center">掲示板</h1>
    <h2>新規投稿</h2>
    <P>名前は20文字、本文は140文字までで入力してください。</P>

    <form action="index.php" method="post" id="form">
        名前: <input type="text" name="name" class="validate[required,maxSize[20]]"><br>
        本文: <textarea name="text" class="validate[required,maxSize[140]]"></textarea><br>
        <button type="submit">投稿</button>
    </form>
    <h2>投稿一覧</h2>
    <?php
        $db = new dbmanage();
        $db->post_list();
    ?>
</body>
</html>
