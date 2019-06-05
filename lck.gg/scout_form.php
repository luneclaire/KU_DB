<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "scout_insert.php";

if (array_key_exists("scout_id", $_GET)) {
    $scout_id = $_GET["scout_id"];
    $query =  "select * from scout natural join team where scout_id = $scout_id";
    $res = mysqli_query($conn, $query);
    $scout = mysqli_fetch_array($res);
    if(!$scout) {
        msg("영입 내역이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "scout_modify.php";
}
else if (array_key_exists("team_id", $_GET)) {
    $team_id = $_GET["team_id"];
    $query =  "select * from team where team_id = $team_id";
    $res = mysqli_query($conn, $query);
    $thisteam = mysqli_fetch_array($res);
}
else if (array_key_exists("nickname", $_GET)) {
    $nickname = $_GET["nickname"];
    $query =  "select * from player where nickname = '$nickname'";
    $res = mysqli_query($conn, $query);
    $thisplayer = mysqli_fetch_array($res);
}

$query = "select * from team order by team_name";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $team[$row['team_id']] = $row['team_name'];
}

$query = "select * from player order by nickname";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $player[$row['nickname']] = $row['nickname'];
}

$query = "select * from season";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $season[$row['year_season']] = $row['year_season'];
}

?>
    <div class="container">
        <form name="scout_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="scout_id" value="<?=$scout['scout_id']?>"/>
            <h3>스카우트 정보 <?=$mode?></h3>
            <p>
                <label for="team_id">팀</label>
                <select name="team_id" id="team_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($id == $scout['team_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            }
                            else if ($id == $thisteam['team_id']){
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
                <label for="nickname">선수</label>
                <select name="nickname" id="nickname">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($player as $id => $name) {
                            if($id == $scout['nickname']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            }
                            else if($id == $thisplayer['nickname']){
                            	echo"<option value='{$name}' selected>{$name}</option>";
                            }
                            else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="year_season">영입 시즌</label>
                <select name="year_season" id="year_season">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($season as $id => $name) {
                            if($id == $scout['year_season']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="position">포지션</label>
                <input type="text" placeholder="포지션 입력(TOP / MID / JGL / ADC / SUP 중 하나로 입력)" id="position" name="position" value="<?=$scout['position']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("team_id").value == "-1") {
                        alert ("팀을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("nickname").value == "-1") {
                        alert ("선수를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("position").value == "") {
                        alert ("포지션을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("position").value != "TOP" && document.getElementById("position").value != "MID" && document.getElementById("position").value != "JGL" && document.getElementById("position").value != "ADC" && document.getElementById("position").value != "SUP"){
                        alert ("포지션을 양식에 맞게 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>