<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rank1 = $_POST['rank1'];
$rank2 = $_POST['rank2'];
$rank3 = $_POST['rank3'];
$rank4 = $_POST['rank4'];
$rank5 = $_POST['rank5'];
$rank6 = $_POST['rank6'];
$rank7 = $_POST['rank7'];
$rank8 = $_POST['rank8'];
$rank9 = $_POST['rank9'];
$rank10 = $_POST['rank10'];
$year_season = $_POST['year_season'];

if($rank1 != -1){
	$ret = mysqli_query($conn, "update season set rank1 = '$rank1' where year_season = '$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank2 != -1){
	$ret = mysqli_query($conn, "update season set rank2 = '$rank2' where year_season ='$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank3 != -1){
	$ret = mysqli_query($conn, "update season set rank3 = '$rank3' where year_season= '$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank4 != -1){
	$ret = mysqli_query($conn, "update season set rank4 = '$rank4' where year_season ='$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank5 != -1){
	$ret = mysqli_query($conn, "update season set rank5 = '$rank5' where year_season ='$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank6 != -1){
	$ret = mysqli_query($conn, "update season set rank6= '$rank6' where year_season= '$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank7 != -1){
	$ret = mysqli_query($conn, "update season set rank7 = '$rank7' where year_season= '$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank8 != -1){
	$ret = mysqli_query($conn, "update season set rank8= '$rank8' where year_season= '$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank9 != -1){
	$ret = mysqli_query($conn, "update season set rank9 = '$rank9' where year_season ='$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}
if($rank10 != -1){
	$ret = mysqli_query($conn, "update season set rank10 = '$rank10' where year_season ='$year_season'");
	if(!$ret) {	msg('Query Error : '.mysqli_error($conn));	}
}

s_msg ('성공적으로 수정 되었습니다');
echo "<meta http-equiv='refresh' content='0;url=season_list.php'>";

?>

