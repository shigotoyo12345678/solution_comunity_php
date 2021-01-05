
<?php

require_once('dbconnect.php');
$pdo = connectDB();

$solution_id = $_POST["solution_id"];
$user_id = $_POST["user_id"];
$niceFlg = $_POST["niceFlg"];
$sql = "";
if ($niceFlg == "0") {
    $sql = "INSERT INTO `nice`(`solution_id`, `user_id`, `niceFlg`) VALUES ($solution_id,$user_id,1)";
} else if ($niceFlg == "1") {
    $sql = "DELETE FROM `nice` WHERE `solution_id`=$solution_id AND `user_id`=$user_id";
}


try {
    //今回ここではSELECT文を送信している。UPDATE、DELETEなどは、また少し記法が異なる。
    $stmt = $pdo->query($sql);

    $mm = 1;
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "できなかったよ";

    $mm = 2;
}
$pdo = null;    //DB切断

echo  $sql . $mm;
