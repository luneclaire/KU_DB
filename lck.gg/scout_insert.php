<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$team_id = $_POST['team_id'];
$nickname = $_POST['nickname'];
$year_season = $_POST['year_season'];
$position= $_POST['position'];


$ret = mysqli_query($conn, "insert into scout (team_id, nickname, year_season, position) values('$team_id', '$nickname', '$year_season', '$position')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=team_view.php?team_id={$team_id}'>";
}

?>