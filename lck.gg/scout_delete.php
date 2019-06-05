<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$scout_id = $_GET['scout_id'];

$query = "select * from team natural join scout natural join player where scout_id = $scout_id";
$res = mysqli_query($conn, $query);
$info = mysqli_fetch_assoc($res);

$ret = mysqli_query($conn, "delete from scout where scout_id = $scout_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=team_view.php?team_id={$info['team_id']}'>";
}
?>