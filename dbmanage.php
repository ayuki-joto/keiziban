<?php
class dbmanage
{
    public function post($name, $text) {
        $dsn = 'mysql:host=localhost;dbname=keiziban;';
        $user ='key';
        $password = '';

        try {
            $db = new PDO($dsn,$user,$password);
            $stmt = $db->prepare('INSERT INTO post(name,contents)VALUES(:name,:contents)');

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':contents', $text, PDO::PARAM_STR);
            // クエリの実行
            $stmt->execute();
            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            die ('エラー:' . $e->getMessage());
        }
    }

    public function post_list(){
        $dsn = 'mysql:host=localhost;dbname=keiziban;';
        $user ='key';
        $password = '';

        try{
            $db = new PDO($dsn,$user,$password);
            $stt = $db->query('SELECT * FROM post ORDER BY id DESC');
            $stt->execute();
            $post_list = $stt->fetchAll();
            if ($post_list !=null){
                foreach ($post_list as $row){
                    echo $row["id"]." ".$row["name"]." ".$row["contents"] .'<br>';
                }
            }
            else{
                echo '投稿内容がありません<br>';
            }
        }catch(PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }
    }
}