<?php


$str = file_get_contents('database_tv.json');
$json = json_decode($str, true);


$db_host = $json['db_host'];
$db_name = $json['db_name'];
$db_user = $json['db_user'];
$db_pass = $json['db_pass'];



define("DB_SERVER", $db_host);
define("DB_USER", $db_user);
define("DB_PASS", $db_pass);
define("DB_NAME", $db_name);




$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());


$q = "SELECT * FROM `injuries` where `league_id` = '39' GROUP BY `team_name` ORDER BY team_name ASC";
$result = mysqli_query($connection, $q);
$num_rows = mysqli_num_rows($result);
if (!$result || ($num_rows < 0)) {
    echo "";
    return;
}
if ($num_rows == 0) {
    echo "";
    return;
}


for ($i = 0; $i < $num_rows; $i++) {

    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_row($result);
    $q4 = "SELECT max(`fixture_date`) FROM `injuries` where `league_id` = '39' AND team_name = '$row[7]' order by id ASC";
    $dateee = mysqli_fetch_row(mysqli_query($connection, $q4));
    $date = $dateee[0];

    $q3 = "SELECT * FROM `injuries` where `fixture_date` = '$date' And `league_id` = '39' AND team_name = '$row[7]' order by id ASC";
    $result3 = mysqli_query($connection, $q3);
    $num_rows3 = mysqli_num_rows($result3);

    echo '<div class="row rowbn" id="' . $i . 'row" onmouseover="zoomimg(' . $i . ')" onmouseenter="underrow(' . $i . ')" onmouseleave="underrowleave(' . $i . ')" style="height: fit-content;">
    <div class="col col-lg-2 " style="  vertical-align: middle; border-radius: 1px; ">
        <img class="teamlogo" id="' . $i . 'logo" src="' . $row[8] . '">
    </div>
    <div class="col-sm " style="margin-top: auto;margin-bottom: auto;font-weight: bold;  border-radius: 1px; ">
    ' . $row[7] . '
    </div>
    <div class="col col-lg-3 " style="margin-top: auto;margin-bottom: auto;font-weight: bold;  border-radius: 1px; ">
        ' . $num_rows3 . '
    </div>
    <div class="col col-lg-1 " style="margin-top: auto;margin-bottom: auto;font-weight: bold;  border-radius: 1px; ">
        <div class="triangle" id="' . $i . 'triangle" onclick="toggletable(' . $i . ');rotate_trng(' . $i . ')"></div>
    </div>
    </div>
    <div id="' . $i . 'table" class="container p-3 my-3 bg-dark text-white tablediv" style="display: none;">
        <table class="table table-dark table-hover table-bordered">
            <thead>
                <tr>
                    <th style="width: 8%;">PLAYER IMAGE</th>
                    <th>PLAYER</th>
                    <th>REASON</th>
                    <th>DATE INJURED </th>
                    <th>STATUS </th>
                </tr>
            </thead>
            <tbody>';

    $q1 = "SELECT * FROM `injuries` where  `fixture_date` = '$date' AND `league_id` = '39' AND team_name = '$row[7]' order by id ASC";
    $result1 = mysqli_query($connection, $q1);
    $num_rows1 = mysqli_num_rows($result1);
    if (!$result1 || ($num_rows1 < 0)) {
        echo "";
        return;
    }
    if ($num_rows1 == 0) {
        echo "";
        return;
    }

    for ($i1 = 0; $i1 < $num_rows1; $i1++) {
        $row1 = mysqli_fetch_row($result1);

        $date = date('Y-m-d', strtotime($row1[10]));

        echo ' <tr>
                <td> <img class="playerimg" src="' . $row1[3] . '" alt="Player Photo"> </td>
                <td> <b> ' . $row1[2] . ' </b> </td>
                <td> ' . $row1[5] . ' </td>
                <td> ' . $date . '  </td>
                <td> ' . $row1[4] . ' </td>
                </tr> ';
    }

    echo '</tbody>
    </table>
    </div> ';
}
