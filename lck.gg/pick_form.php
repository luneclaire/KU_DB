<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "pick_insert.php";

if (array_key_exists("game_id", $_GET)) {
    $game_id = $_GET["game_id"];
    $query =  "select * from game where game_id = $game_id";
    $res = mysqli_query($conn, $query);
    $game = mysqli_fetch_array($res);
    if(!$game) {
        msg("경기가 존재하지 않습니다.");
    }
}

$query = "select game_id, team_name, nickname from game_simple natural join team natural join scout where (team_name = winner or team_name = loser) and game_id = $game_id";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $player[$row['nickname']] = $row['nickname'];
}

$query = "select * from champion";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $cham_name[$row['cham_name']] = $row['cham_name'];
}
?>
    <div class="container">
        <form name="pick_form" action="<?=$action?>" method="post" class="fullwidth">
        	<input type="hidden" name="game_id" value="<?=$game_id?>"/>
            <h3>픽 정보 <?=$mode?></h3>
            <p>
                <label for="player">선수</label>
                <select name="player" id="player">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($player as $id => $name) {
                            if($id == $scout['team_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            }
                            else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="champion">챔피언</label>
                <select name="champion" id="champion">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($cham_name as $name => $name) {
                                echo "<option value='{$name}'>{$name}</option>";
                        }
                    ?>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("player").value == "-1") {
                        alert ("선수를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("champion").value == "-1") {
                        alert ("챔피언을 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>