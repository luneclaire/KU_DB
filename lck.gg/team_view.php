<?
include "header2.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("team_id", $_GET)) {
    $team_id = $_GET["team_id"];
    $query = "select * from team natural left outer join (scout natural join player) where team_id = $team_id";
    $res = mysqli_query($conn, $query);
    $team = mysqli_fetch_assoc($res);
    /*if (!$team) {
        msg("팀이 존재하지 않습니다.");
    }*/
}
?>
    <div class="container fullwidth">

        <h3>팀별 스카우트 정보 : <? echo $team['team_name']?></h3>

        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>선수</th>
            <th>영입 시즌</th>
            <th>포지션</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        $query = "select * from team natural left outer join (scout natural join player) where team_id = $team_id order by year_season";
    	$res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['nickname']}</td>";
            echo "<td>{$row['year_season']}</td>";
            echo "<td>{$row['position']}</td>";
            echo "<td width='17%'>
                <a href='scout_form.php?scout_id={$row['scout_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['scout_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
   
        <script>
        function deleteConfirm(scout_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "scout_delete.php?scout_id=" + scout_id;
            }else{   //취소
                return;
            }
        }
    </script>

    </div>
<? include("footer.php") ?>