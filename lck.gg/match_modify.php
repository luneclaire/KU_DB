<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$game_id = $_POST['game_id'];
$year_season = $_POST['year_season'];
$game_type = $_POST['game_type'];
$round = $_POST['round'];
$set_num = $_POST['set_num'];
$winner = $_POST['winner'];
$loser = $_POST['loser'];

echo $game_id; echo $year_season;

$ret = mysqli_query($conn, "update game set year_season = '$year_season', game_type = '$game_type', round = $round, set_num = $set_num, winner = '$winner', loser = '$loser' where game_id = $game_id");


if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=match_list.php'>";
}

?>