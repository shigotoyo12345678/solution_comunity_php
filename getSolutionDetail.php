<?php

require_once('dbconnect.php');
$pdo = connectDB();

$solution_id = $_POST["solution_id"];
$user_id = $_POST["user_id"];

$sql = "SELECT `account`.`user_id`,`user_name`, `solution_name`,`content`,SUM(`nice`.`niceFlg`) AS niceSum , (SELECT `niceFlg` FROM `nice` WHERE `user_id`=$user_id AND `solution_id`=$solution_id) AS myFlg FROM `solution` LEFT JOIN `account` ON solution.user_id=account.user_id JOIN `nice` ON `solution`.`solution_id`=`nice`.`solution_id` WHERE `solution`.`solution_id`=$solution_id";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $hoge = array();

    // 取得したデータを出力
    foreach ($stmt as $value) {
        array_push($hoge, array("user_id" => $value["user_id"], "user_name" => $value["user_name"], "solution_name" => $value["solution_name"], "solution" => $value["content"], "niceSum" => $value["niceSum"], "myFlg" => $value["myFlg"]));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断


$hoge = json_encode($hoge, JSON_UNESCAPED_UNICODE);

echo  $hoge;
