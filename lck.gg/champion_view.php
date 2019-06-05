<?
include "header_cham.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("cham_name", $_GET)) {
    $cham_name = $_GET["cham_name"];
    $query = "select * from champion where cham_name = '$cham_name'";
    $res = mysqli_query($conn, $query);
    $cham = mysqli_fetch_assoc($res);
    if (!$cham) {
        msg("챔피언이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">
        <h3>챔피언 정보 상세 보기</h3>

        <p>
            <label for="cham_name">챔피언 이름</label>
            <input readonly type="text" id="cham_name" name="cham_name" value="<?= $cham['cham_name'] ?>"/>
        </p>

        <p>
            <label for="cham_desc">챔피언 설명</label>
            <input readonly type="text" id="cham_desc" name="cham_desc" value="<?= $cham['cham_desc'] ?>"/>
        </p>
        
        <p><label>픽된 경기</label></p>
        
        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>경기</th>
            <th>선수</th>
            <th>포지션</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        $query = "select * from pick natural join game natural join scout_simple natural join team where (team_name = winner or team_name = loser) and cham_name = '$cham_name'";
    	$res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($res)) {
        	
            echo "<tr>";
            if ($row['game_type'] == "P"){
            	echo "<td>{$row['year_season']} 포스트시즌 {$row['winner']} vs {$row['loser']} {$row['set_num']}세트</td>";
            }
            else{
            	echo "<td>{$row['year_season']} 정규시즌 {$row['winner']} vs {$row['loser']} {$row['round']}라운드 {$row['set_num']}세트</td>";
            }
            echo "<td>{$row['nickname']}</td>";
            echo "<td>{$row['position']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    </div>
<? include("footer.php") ?>