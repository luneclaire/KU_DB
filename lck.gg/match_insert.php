<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$year_season = $_POST['year_season'];
$game_type = $_POST['game_type'];
$round = $_POST['round'];
$set_num = $_POST['set_num'];
$winner = $_POST['winner'];
$loser = $_POST['loser'];


$ret = mysqli_query($conn, "insert into game (year_season, game_type, round, set_num, winner, loser) values('$year_season', '$game_type', $round, $set_num, '$winner', '$loser')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=match_list.php'>";
}

?>