<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("year_season", $_GET)) {
    $year_season = $_GET["year_season"];
    $query =  "select * from season where year_season = '$year_season'";
    $res = mysqli_query($conn, $query);
    $season = mysqli_fetch_array($res);
    if(!$season) {
        msg("시즌 내역이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "season_modify.php";
}

$team = array();

$query = "select * from team order by team_name";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $team[$row['team_id']] = $row['team_name'];
}


?>
    <div class="container">
        <form name="scout_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="year_season" value="<?=$season['year_season']?>"/>
            <h3>시즌 정보 <?=$mode?></h3>
            <p>
                <label for="rank1">우승</label>
                <select name="rank1" id="rank1">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank1']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
                        <p>
                <label for="rank2">준우승</label>
                <select name="rank2" id="rank2">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank2']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
                        <p>
                <label for="rank3">3위</label>
                <select name="rank3" id="rank3">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank3']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="rank4">4위</label>
                <select name="rank4" id="rank4">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank4']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="rank5">5위</label>
                <select name="rank5" id="rank5">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank5']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="rank6">6위</label>
                <select name="rank6" id="rank6">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank6']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
                        <p>
                <label for="rank7">7위</label>
                <select name="rank7" id="rank7">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank7']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
                        <p>
                <label for="rank8">8위</label>
                <select name="rank8" id="rank8">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank8']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="rank9">9위</label>
                <select name="rank9" id="rank9">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank9']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="rank10">10위</label>
                <select name="rank10" id="rank10">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($team as $id => $name) {
                            if($name == $season['rank10']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>           
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

        </form>
    </div>
<? include("footer.php") ?>