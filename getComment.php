<?php

require_once('dbconnect.php');
$pdo = connectDB();

$solution_id = $_POST["solution_id"];

$sql = "SELECT `comment` FROM `comment` WHERE `solution_id`=$solution_id";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $hoge = array();
    $hoge2 = array("comment" => $hoge);

    // 取得したデータを出力
    foreach ($stmt as $value) {
        array_push($hoge, array("commentText" => $value["comment"]));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

//array_push($hoge2, $hoge);
$hoge2 = array("comment" => $hoge);

$hoge2 = json_encode($hoge2, JSON_UNESCAPED_UNICODE);

echo  $hoge2;
