<?php
require_once 'email.php';
require_once 'connect.php';

$select_db = mysqli_select_db($conn, 'login') or die($dberror2);


$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['pass1'];
$email = $_POST['email'];
$confirm = rand(1,1000);

$insert = "INSERT INTO users (firstname, lastname, username, password, email, confirmcode) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$confirm')";
if(!mysqli_query($conn, $insert)){
    echo "Error";
} else {
    $mail->addAddress($email, '');
    $mail->msgHTML("Please confirm your account using this code: " . $confirm . "\n");

    if (!$mail->send()) {
        echo '<script language="javascript">';
        echo 'alert("Activation Code could not be sent."' . $mail->ErrorInfo . ')';
        echo '</script>';
        exit;
    } else {
        echo '<script language="javascript">';
        echo 'alert("Activation Code has been sent to: "' . $email . ')';
        echo '</script>';
        header("Location:activation.php");
        exit;
    }
}


?>

