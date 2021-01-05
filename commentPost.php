
<?php

require_once('dbconnect.php');
$pdo = connectDB();

$solution_id = $_POST["solution_id"];
$user_id = $_POST["user_id"];
$comment = $_POST["comment"];

$sql = "INSERT INTO `comment`( `solution_id`, `user_id`, `comment`) VALUES ($solution_id,$user_id,'$comment')";


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
