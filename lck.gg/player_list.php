<?
include "header3.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from scout_current2 natural left outer join scout_current order by nickname";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  "select * from scout_current2 natural left outer join scout_current where nickname like '%$search_keyword%' or name like '%$search_keyword%' order by nickname";
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>닉네임</th>
            <th>본명</th>
            <th>현재 소속 팀</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='player_view.php?nickname={$row['nickname']}'>{$row['nickname']}</a></td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['team_name']}</td>";
            echo "<td width='19%'>
                <a href='scout_form.php?nickname={$row['nickname']}'><button class='button primary small'>스카우트 정보 추가</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
