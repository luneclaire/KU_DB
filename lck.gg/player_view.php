<?
include "header3.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("nickname", $_GET)) {
    $nickname = $_GET["nickname"];
    $query = "select * from player natural left outer join (scout natural join team) where nickname = '$nickname'";
    $res = mysqli_query($conn, $query);
    $player = mysqli_fetch_assoc($res);
    if (!$player) {
        msg("선수가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">
        <h3>선수 정보 상세 보기</h3>

        <p>
            <label for="nickname">선수 닉네임</label>
            <input readonly type="text" id="nickname" name="nickname" value="<?= $player['nickname'] ?>"/>
        </p>

        <p>
            <label for="name">선수 본명</label>
            <input readonly type="text" id="name" name="name" value="<?= $player['name'] ?>"/>
        </p>
        
        <p><label>스카우트 목록</label></p>

        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>소속 팀</th>
            <th>영입 시즌</th>
            <th>포지션</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
         $query = "select * from player natural left outer join (scout natural join team) where nickname = '$nickname' order by year_season desc";
    $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['team_name']}</td>";
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