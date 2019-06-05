<?
include "header2.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("game_id", $_GET)) {
    $game_id = $_GET["game_id"];
    $query = "select * from game where game_id = $game_id";
    $res = mysqli_query($conn, $query);
    $game = mysqli_fetch_assoc($res);
    if (!$game) {
        msg("경기가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>
        <? echo $game['year_season']?>-
        <?
        if ($game['game_type'] == "P"){
        	echo "포스트 시즌 ";
        	echo $game['winner']; echo " vs "; echo $game['loser']; echo " ";
        	echo $game['set_num']; echo "세트";
        }
        else {
        	echo "정규 시즌";
        	echo $game['round']; echo "라운드";
        	echo $game['winner']; echo " vs "; echo $game['loser']; echo " ";
        	echo $game['set_num']; echo "세트";
        	
        }
        ?>
        </h3>
        
        <p><label>경기 픽 정보</label></p>

        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>팀</th>
            <th>선수</th>
            <th>포지션</th>
            <th>챔피언</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        $query = "select * from pick_order natural join pick_order3 where game_id = $game_id order by team_name";
    	$res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['team_name']}</td>";
            echo "<td>{$row['nickname']}</td>";
            echo "<td>{$row['position']}</td>";
            echo "<td>{$row['cham_name']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>


    </div>
<? include("footer.php") ?>