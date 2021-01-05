<?php

require_once('dbconnect.php');
$pdo = connectDB();

$user_id = $_POST["user_id"];
$title = $_POST["title"];
$content = $_POST["content"];

$sql = "INSERT INTO `solution`( `user_id`, `solution_name`, `content`) VALUES ('" . $user_id . "','" . $title . "','" . $content . "')";
try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $answer = "登録できました";
} catch (PDOException $e) {
    var_dump($e->getMessage());
    $answer = "登録できませんでした";
}
$pdo = null;    //DB切断

$answer = json_encode($answer, JSON_UNESCAPED_UNICODE);

echo $answer;
