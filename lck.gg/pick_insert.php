﻿<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$game_id = $_POST['game_id'];
$player = $_POST['player'];
$champion = $_POST['champion'];

$ret = mysqli_query($conn, "insert into pick (game_id, nickname, cham_name) values('$game_id', '$player', '$champion')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=match_view.php?game_id={$game_id}'>";
}

?>