<?php

require_once('dbconnect.php');
$pdo = connectDB();

$me_id = $_POST["me_id"];
$hoge = array();
$hoge2 = array();
try {

    $sql = "SELECT DISTINCT `user1`,`user2` FROM `talk` WHERE `user1`=$me_id OR `user2`=$me_id";

    $stmt = $pdo->query($sql);

    foreach ($stmt as $value) {
        if ($value["user1"] != $me_id) {
            array_push($hoge, $value["user1"]);
        } else {
            array_push($hoge, $value["user2"]);
        }
    }

    foreach ($hoge as $value) {
        $sql = "SELECT  `user_id`,`user_name` FROM `account` WHERE `user_id`=$value";

        //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
        $stmt = $pdo->query($sql);

        // 取得したデータを出力
        foreach ($stmt as $value) {
            array_push($hoge2, array("user_id" => $value["user_id"], "user_name" => $value["user_name"]));
        }
    }

    $hoge3 = array("talks" => $hoge2);
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

//array_push($hoge2, $hoge);
$hoge3 = array("talks" => $hoge2);

$hoge3 = json_encode($hoge3, JSON_UNESCAPED_UNICODE);

echo  $hoge3;
