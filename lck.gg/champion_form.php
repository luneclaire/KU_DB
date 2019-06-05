<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "champion_insert.php";


?>
    <div class="container">
           
            <form name="champion_form" action="<?=$action?>" method="post" class="fullwidth">
                 	
            <h3>챔피언 등록</h3>
            <p>
                <label for="cham_name">챔피언 이름</label>
                <input type="text" id="cham_name" name="cham_name" value="<?=$champion['cham_name']?>"/>
            </p>
            <p>
                <label for="cham_desc">챔피언 설명</label>
                <input type="text" id="cham_desc" name="cham_desc" value="<?=$champion['cham_desc']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();">챔피언 등록하기</button></p>

            <script>
                function validate() {
                    if(document.getElementById("cham_name").value == "") {
                        alert ("챔피언 이름을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>
    
