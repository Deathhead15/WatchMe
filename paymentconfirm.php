<?php
require_once 'connect.php';

if(isset($_POST['regprem'])) {
    $select_db = mysqli_select_db($conn, 'login') or die($dberror2);
    $username = $_POST['username'];
    $month = $_POST['month'];
    $now = new DateTime();
    $datestart = date('Y-m-j');

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $numrows = mysqli_num_rows($query);
    if ($numrows !== 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $dbusername = $row['username'];

        }
        if ($username == $dbusername) {
            $actquery = mysqli_query($conn, "UPDATE users SET premium='1', date_start=NOW(), date_end=DATE_ADD(NOW(),INTERVAL $month MONTH), month = $month WHERE username='$dbusername'");
            if (!$actquery) {
                echo '<script>';
                echo 'alert("Record is not updated!")';
                echo '</script>';
            } else {
                    header("Location:index.php");
                exit;
                }
            }
    }
}


