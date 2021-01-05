<?php

require_once('dbconnect.php');
$pdo = connectDB();

$me_id = $_POST["myId"];
$you_id = $_POST["you_id"];
$talk = $_POST["talk"];

$nums = turn($me_id, $you_id);

$sql = "INSERT INTO `talk`(`user1`, `user2`, `talk_user`, `talk_content`) VALUES ($nums[0],$nums[1],$me_id,'$talk')";
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

echo $you_id . $sql . $answer;

function turn($num1, $num2)
{

    $nums = [$num1, $num2];

    sort($nums);

    return $nums;
}
