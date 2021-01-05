<?php
session_start();

$me_id = $_POST["myId"];
$you_id = $_POST["yourId"];

$nums = turn($me_id, $you_id);

require_once('dbconnect.php');
$pdo = connectDB();

// tryにPDOの処理を記述
try {

    $sql = "SELECT `talk_content`,`talk_user` FROM talk WHERE `user1`=$nums[0] AND `user2`=$nums[1]";

    $stmt = $pdo->query($sql);

    $hoge = array();
    $hoge2 = array("talk" => $hoge);

    foreach ($stmt as $row) {
        if ($row["talk_user"] == $me_id) {
            array_push($hoge, array("meTalk" => $row["talk_content"]));
        } else if ($row["talk_user"] != $me_id) {
            array_push($hoge, array("yourTalk" => $row["talk_content"]));
        }
    }



    // エラー（例外）が発生した時の処理を記述
} catch (PDOException $e) {

    // エラーメッセージを表示させる
    echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
    exit;
}

//array_push($hoge2, $hoge);
$hoge2 = array("talk" => $hoge);

$hoge2 = json_encode($hoge2, JSON_UNESCAPED_UNICODE);

echo  $hoge2;


function turn($num1, $num2)
{

    $nums = [$num1, $num2];

    sort($nums);

    return $nums;
}

function getName($user_id, $dbh)
{

    $user_name = "";
    // tryにPDOの処理を記述
    try {

        $sql = "SELECT `user_name` FROM `account` WHERE `user_id`=$user_id";

        echo "<br>";

        $stmt = $dbh->query($sql);

        foreach ($stmt as $row) {
            $user_name = $row["user_name"];
        }

        return $user_name;
        // エラー（例外）が発生した時の処理を記述
    } catch (PDOException $e) {

        // エラーメッセージを表示させる
        echo 'データベースにアクセスできません！' . $e->getMessage();

        // 強制終了
        exit;
    }
}
