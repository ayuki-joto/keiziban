<?php

    $pdo = new PDO('mysql:host=localhost;dbname=keiziban;','root');

    if (isset($_POST['name']) && isset($_POST['text'])) {

        $name = $_POST['name'];
        $text = $_POST['contents'];
        //セキュリティー
        $name = htmlspecialchars($name);
        $text = htmlspecialchars($text);

    }
    elseif (!isset($_POST['name'])){
        echo '名前が入力されていません';
        header('Location: index.html');
        exit();
    }
    elseif (!isset($_POST['text'])){
        echo '投稿の中身がありません';
        header('Location: index.html');
        exit();
    }

    else{
        header('Location: index.html');
        exit();
    }

    $dsn = 'mysql:host=localhost;dbname=keiziban;';
    $user ='root';
    $password = '';

    try{
        $db = new PDO($dsn,$user,$password);
        $stmt = $db -> prepare('INSERT INTO post(name,contents)VALUES(:name,:contents)');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':contents', $text, PDO::PARAM_STR);
        // クエリの実行
        $stmt->execute();
        header('Location: index.html');
        exit();
    }
    catch(PDOException $e) {
        die ('エラー:' . $e->getMessage());
    }
