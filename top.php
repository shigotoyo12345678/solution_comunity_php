<?php

require_once('dbconnect.php');
$pdo = connectDB();

$me_id = $_POST["me_id"];

$sql = "SELECT * FROM `account` WHERE `user_id`='" . $me_id . "'";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $name = array();
    // 取得したデータを出力
    foreach ($stmt as $value) {
        array_push($name, array("name" =>  $value["user_name"]));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

$name = json_encode($name, JSON_UNESCAPED_UNICODE);

echo $name;
