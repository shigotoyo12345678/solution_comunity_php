<?php

require_once('dbconnect.php');
$pdo = connectDB();

$name = $_POST["name"];
$pass = $_POST["pass"];

$sql = "INSERT INTO `account`(`user_name`, `pass`) VALUES ('" . $name . "','" . $pass . "')";

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
