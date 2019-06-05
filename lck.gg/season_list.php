<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from season where year_season > '2017' order by year_season desc";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>시즌</th>
            <th>우승</th>
            <th>준우승</th>
            <th>3위</th>
            <th>4위</th>
            <th>5위</th>
            <th>6위</th>
            <th>7위</th>
            <th>8위</th>
            <th>9위</th>
            <th>10위</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['year_season']}</td>";
            echo "<td>{$row['rank1']}</td>";
            echo "<td>{$row['rank2']}</td>";
            echo "<td>{$row['rank3']}</td>";
            echo "<td>{$row['rank4']}</td>";
            echo "<td>{$row['rank5']}</td>";
            echo "<td>{$row['rank6']}</td>";
            echo "<td>{$row['rank7']}</td>";
            echo "<td>{$row['rank8']}</td>";
            echo "<td>{$row['rank9']}</td>";
            echo "<td>{$row['rank10']}</td>";
            echo "<td width='10%'>
                <a href='season_form.php?year_season={$row['year_season']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
