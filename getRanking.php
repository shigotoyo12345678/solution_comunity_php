<?php

require_once('dbconnect.php');
$pdo = connectDB();

$sql = "SELECT `solution`.`solution_id`,`solution`.`solution_name`  FROM `nice` JOIN `solution` ON `nice`.`solution_id`=`solution`.`solution_id` WHERE 1 GROUP BY `solution_id` ORDER BY SUM(`niceFlg`) DESC";

try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $hoge = array();
    $hoge2 = array("ranking" => $hoge);

    // 取得したデータを出力
    foreach ($stmt as $value) {
        array_push($hoge, array("solution_name" => $value["solution_name"], "solution_id" => $value["solution_id"]));
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";
}
$pdo = null;    //DB切断

//array_push($hoge2, $hoge);
$hoge2 = array("ranking" => $hoge);

$hoge2 = json_encode($hoge2, JSON_UNESCAPED_UNICODE);

echo  $hoge2;
