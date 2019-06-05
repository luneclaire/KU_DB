<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cham_name = $_POST['cham_name'];
$cham_desc = $_POST['cham_desc'];


$ret = mysqli_query($conn, "insert into champion (cham_name, cham_desc) values('$cham_name', '$cham_desc')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=champion_list.php'>";
}

?>