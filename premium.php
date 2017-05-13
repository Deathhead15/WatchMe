<?php
session_start();
require_once 'connect.php';


@$user = $_COOKIE['user'];
$select_db = mysqli_select_db($conn, 'login') or die($dberror2);
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
$numrows = mysqli_num_rows($query);
if($numrows!==0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $dbusername = $row['username'];
        $dblastname = $row['lastname'];
        $dbfirstname = $row['firstname'];
        $dbemail = $row['email'];
    }
} else {
    die("Data not found");
}

/*
if(isset($_POST["submit"]) && !empty($_POST["submit"])) {

    $chkuser = $_POST['username'];
    $chkpass = $_POST['password'];
    $chkadmin = $_POST['admin'];

    $select_db = mysqli_select_db($conn, 'login') or die($dberror2);
    if($chkadmin==true){
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$chkuser'");
        $numrows = mysqli_num_rows($query);
        if($numrows!==0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                $dbusername = $row['username'];
                $dblastname = $row['lastname'];
                $dbfirstname = $row['firstname'];
                $dbemail = $row['email'];
            }
            if($chkuser==$dbusername&&$chkpass==$dbpassword)
            {
                echo '<script language="javascript">';
                echo 'alert("You are logged in!")';
                echo '</script>';
                @$_SESSION ['username'] = $dbusername;
                $_SESSION['is_valid'] = true;
                header("Location:admin/index.php");
            }
            else {
                echo '<script language="javascript">';
                echo 'alert("You have inputted an invalid username or password!")';
                echo '</script>';
            }
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("You do not have Admin Privileges!")';
            echo '</script>';
        }
    } else {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$chkuser'");
        $numrows = mysqli_num_rows($query);
        if($numrows!==0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                $dbusername = $row['username'];
                $dblastname = $row['lastname'];
                $dbfirstname = $row['firstname'];
                $dbemail = $row['email'];
                $dbactivated = $row['activated'];
            }
            if($chkuser==$dbusername&&$chkpass==$dbpassword)
            {
                if($dbactivated!=1)
                {
                    header("Location:activation.php");
                    exit;
                } else
                {
                    echo '<script language="javascript">';
                    echo 'alert("You are logged in!")';
                    echo '</script>';
                    @$_SESSION ['username'] = $dbusername;
                    $_SESSION['is_valid'] = true;
                    header("Location:../watch/index.php");
                }
            }
            else {
                echo '<script language="javascript">';
                echo 'alert("You have inputted an invalid username, password or code!")';
                echo '</script>';
            }
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("User does not exists!")';
            echo '</script>';
        }
    }
} */
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Watch Me Inc.</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Flat Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>

        function checkPayment()
        {

            var x = document.getElementsByName("payment")[0].value;
            if (x == null || x == "") {
                document.getElementsByName("payment")[0].style.backgroundColor = "red";

                msglname = "Payment should be filled out";
                document.getElementById("left").innerHTML = msglname;
            } else {

                document.getElementsByName("payment")[0].style.backgroundColor = "lightgreen";
                document.getElementById("left").innerHTML = "";
                msglname = x;
            }
        }

        function checkMonth()
        {

            var x = document.getElementsByName("month")[0].value;
            if (x == null || x == "") {
                document.getElementsByName("month")[0].style.backgroundColor = "red";

                msglname = "No. of Months should be filled out";
                document.getElementById("left").innerHTML = msglname;
            } else {

                document.getElementsByName("month")[0].style.backgroundColor = "lightgreen";
                document.getElementById("left").innerHTML = "";
                msglname = x;
            }
        }

    </script>
</head>


<div class="container">
    <div class="flat-form">
        <ul class="tabs">
            <li>
                <a href="#premium" class="active">Premium User Payment</a>
            </li>
        </ul>
        <div id="premium" class="form-action show">
            <h1>Payment Details</h1>

            <form method="post" action="paymentconfirm.php" name="login">
                <ul>
                    <li>Firstname:
                        <input type="text" placeholder="Firstname" value="<?php echo $dbfirstname; ?>" name="firstname" readonly/>
                    </li>
                    <li>
                        Lastname:
                        <input type="text" placeholder="Lastname" value="<?php echo $dblastname; ?>" name="lastname" readonly/>
                    </li>
                    <li>
                        Username:
                        <input type="text" placeholder="Username" value="<?php echo $dbusername; ?>" name="username" readonly/>
                    </li>
                    <li>
                        Email Address:
                        <input type="text" placeholder="E-mail" value="<?php echo $dbemail; ?>" name="email" readonly/>
                    </li>
                    <li>
                        Payment Options: <select name="payment" onblur="checkPayment()" required>
                            <option></option>
                            <option value="visa">Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="amex">American Express</option>
                            <option value="debit">Debit Card</option>
                            </select>
                    </li>
                    <li>
                        No. of Month(s) <select name="month" onblur="checkMonth()" required>
                            <option></option>
                            <option value="1">1 Month - $10.00</option>
                            <option value="2">2 Months - $20.00</option>
                            <option value="3">3 Months - $30.00</option>
                            <option value="4">4 Months - $40.00</option>
                            <option value="5">4 Months - $50.00 </option>
                            <option value="6">4 Months - $60.00</option>
                            <option value="7">4 Months - $70.00</option>
                            <option value="8">4 Months - $80.00</option>
                            <option value="9">4 Months - $90.00</option>
                            <option value="10">4 Months - $100.00</option>
                            <option value="11">4 Months - $110.00</option>
                            <option value="12">4 Months - $120.00</option>
                        </select>
                    </li>
                    <li>
                        <input type="submit" name="regprem" value="Submit" class="button" />
                    </li>
                </ul>
            </form>
            <p class="terms">By clicking submit you agree to all our terms and condition. And pay the subscription fee.</p>
        </div>
        <!--/#register.form-action-->
        <div id = "left">

        </div>

    </div>

</div>
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
