<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "match_insert.php";

if (array_key_exists("game_id", $_GET)) {
    $game_id = $_GET["game_id"];
    $query =  "select * from game where game_id = $game_id";
    $res = mysqli_query($conn, $query);
    $game = mysqli_fetch_array($res);
    if(!$game) {
        msg("게임 내역이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "match_modify.php";
}

$query = "select * from team order by team_name";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $team[$row['team_id']] = $row['team_name'];
}

$query = "select * from season";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $season[$row['year_season']] = $row['year_season'];
}

?>
    <div class="container">
        <form name="match_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="game_id" value="<?=$game['game_id']?>"/>
            <h3>경기 정보 <?=$mode?></h3>
            <p>
                <label for="season">시즌</label>
                <select name="year_season" id="year_season">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($season as $id => $name) {
                            if($id == $game['year_season']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="game_type">정규시즌 / 포스트시즌</label>
                <input type="text" placeholder="정규시즌은 R, 포스트시즌은 P로 입력" id="game_type" name="game_type" value="<?=$game['game_type']?>"/>
            </p>
            <p>
                <label for="round">라운드</label>
                <input type="number" placeholder="정수로 입력. 포스트시즌의 경우 0으로 입력" id="round" name="round" value="<?=$game['round']?>"/>
            </p>
            <p>
                <label for="set_num">세트</label>
                <input type="number" placeholder="정수로 입력" id="set_num" name="set_num" value="<?=$game['set_num']?>"/>
            </p>
            <p>
                <label for="winner">승팀</label>
                <select name="winner" id="winner">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $game['winner']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            }
                            else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="loser">패팀</label>
                <select name="loser" id="loser">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $game['loser']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            }
                            else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("year_season").value == "-1") {
                        alert ("시즌을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("game_type").value == "") {
                        alert ("정규/포스트 시즌을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("game_type").value != "P" && document.getElementById("game_type").value != "R") {
                        alert ("정규/포스트 시즌을 R/P로 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("round").value == "") {
                        alert ("라운드를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("set_num").value == "") {
                        alert ("세트를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("winner").value == "-1") {
                        alert ("승팀을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("loser").value == "-1") {
                        alert ("패팀을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("loser").value == document.getElementById("winner").value) {
                        alert ("승팀과 패팀이 같습니다"); return false;
                    }
                    else return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>