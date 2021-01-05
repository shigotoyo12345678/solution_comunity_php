<?php

require_once('dbconnect.php');
$pdo = connectDB();

$name = $_POST["name"];

$sql = "SELECT `user_id` as id FROM `account` WHERE `user_name`='" . $name . "'";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);
    $answer = null;
    foreach ($stmt as $value) {
        $answer = $value["id"];
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    $answer = "接続できなかったよ";
}
$pdo = null;    //DB切断

$answer = json_encode($answer, JSON_UNESCAPED_UNICODE);

echo $answer;
