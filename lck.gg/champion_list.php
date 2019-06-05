<?
include "header_cham.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select cham_name, cham_desc, count(game_id) as sum_pick from champion natural left outer join pick group by cham_name order by cham_name";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  "select cham_name, cham_desc, count(game_id) as sum_pick from champion natural left outer join pick where cham_name like '%$search_keyword%' group by cham_name order by cham_name";
    }
   

    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    
    <p align="center"><a href='champion_form.php'><button class="button primary large">챔피언 추가</button></a></p>

    <p><table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>챔피언</th>
            <th>설명</th>
            <th>픽 수</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='champion_view.php?cham_name={$row['cham_name']}'>{$row['cham_name']}</a></td>";
            echo "<td>{$row['cham_desc']}</td>";
            echo "<td>{$row['sum_pick']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table></p>
    
    
    
</div>
<? include("footer.php") ?>
