<?
include "header_game.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from game";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  "select * from game where winner like '%$search_keyword%' or loser like '%$search_keyword%'";
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>시즌</th>
            <th>정규/포스트시즌</th>
            <th>라운드</th>
            <th>세트</th>
            <th>승팀</th>
            <th>패팀</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['year_season']}</td>";
            echo "<td>{$row['game_type']}</td>";
            echo "<td>{$row['round']}</td>";
            echo "<td>{$row['set_num']}</td>";
            echo "<td>{$row['winner']}</td>";
            echo "<td>{$row['loser']}</td>";
            echo "<td width='15%'>
                <a href='match_view.php?game_id={$row['game_id']}'><button class='button small'>PICK 보기</button></a>
                <a href='pick_form.php?game_id={$row['game_id']}'><button class='button small'>PICK 추가</button></a>
                <a href='match_form.php?game_id={$row['game_id']}'><button class='button primary small'>경기 수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['game_id']})' class='button danger small'>경기 삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    
    <script>
        function deleteConfirm(game_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "match_delete.php?game_id=" + game_id;
            }else{   //취소
                return;
            }
        }
    </script>
    
     <p align="center"><a href='match_form.php'><button class="button primary large">경기 추가</button></a></p>

</div>
<? include("footer.php") ?>
