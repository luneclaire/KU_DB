<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$scout_id = $_POST['scout_id'];
$team_id = $_POST['team_id'];
$nickname = $_POST['nickname'];
$year_season = $_POST['year_season'];
$position= $_POST['position'];

$ret = mysqli_query($conn, "update scout set team_id = $team_id, nickname = '$nickname', year_season = '$year_season', position = '$position' where scout_id = $scout_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=team_view.php?team_id={$team_id}'>";
}

?>

