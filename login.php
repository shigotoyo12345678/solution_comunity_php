<?php

require_once('dbconnect.php');
$pdo = connectDB();

$name = $_POST["name"];

$sql = "SELECT * FROM `account` WHERE `user_name`='" . $name . "'";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $pass = array();
    // 取得したデータを出力
    foreach ($stmt as $value) {
        array_push($pass, array("password" =>  $value["pass"], "id" => $value["user_id"]));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

$pass = json_encode($pass, JSON_UNESCAPED_UNICODE);

echo $pass;
