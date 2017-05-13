<?php
require_once 'connect.php';

$select_db = mysqli_select_db($conn, 'login') or die($dberror2);


$username = $_POST['username'];
setcookie('user', $username);
$password = $_POST['password'];
$confirmcode = $_POST['actcode'];
$prem = $_POST['premium'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$numrows = mysqli_num_rows($query);
if($numrows!==0)
{
    while($row = mysqli_fetch_assoc($query))
    {
        $dbusername = $row['username'];
        $dbpassword = $row['password'];
        $dbconfirm = $row['confirmcode'];
    }
    if($username==$dbusername&&$password==$dbpassword&&$confirmcode==$dbconfirm)
    {
        echo '<script>';
        echo 'alert("Your account is confirmed!")';
        echo '</script>';
        $actquery = mysqli_query($conn, "UPDATE users SET activated='1' WHERE username='$dbusername'");
        if(!$actquery){
            echo '<script>';
            echo 'alert("Record is not updated!")';
            echo '</script>';
        } else {
            if(isset($prem)){
                @$_SESSION ['username'] = $dbusername;
                header("Location:premium.php");
            } else {
                @$_SESSION ['username'] = $dbusername;
                header("Location:index.php");
            }
        }
    }
    else{
        echo '<script>';
        echo 'alert("You have inputted an invalid username, password or code!")';
        echo '</script>';
        header("Location:activation.php");
        exit;
    }
} else {
    echo '<script language="javascript">';
    echo 'alert("User does not exists!")';
    echo '</script>';
    header("Location:activation.php");
    exit;
}


