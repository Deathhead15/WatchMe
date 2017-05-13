<?php
session_start();

if(isset($_SESSION['is_valid'])){
    unset($_SESSION['is_valid']);
}

if(isset($_COOKIE['user'])){
    unset($_COOKIE['user']);
}


require_once 'connect.php';

if(isset($_POST["submit"]) && !empty($_POST["submit"])) {

    $chkuser = $_POST['username'];
    $chkpass = $_POST['password'];
    $chkadmin = $_POST['admin'];

    $select_db = mysqli_select_db($conn, 'login') or die($dberror2);
    if($chkadmin==true){
        $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$chkuser'");
        $numrows = mysqli_num_rows($query);
        if($numrows!==0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
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
                $dbpassword = $row['password'];
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
                    setcookie('user', $dbusername);
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
}

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
</head>
<script type="text/javaScript">
        var msgfname = "";
        var msglname = "";
        var msgmail = "";
        var msgpass = "";
        var msgpass2 = "";
        var msgpass1 = "";
        var pm = "";

        function focusFunc(name) {
            document.getElementsByName(name)[0].style.backgroundColor = "yellow";
            
        }

        function checkPass1() {
            p1 = document.getElementsByName("pass1")[0].value;
            if (p1 == null || p1 == ""){
                msgpass1 = "Password is Required";
                document.getElementById("left").innerHTML = msgpass1;
                document.getElementsByName("pass1")[0].style.backgroundColor = "red";
                
                msgpass = msgpass1;
            } else {
                
                document.getElementsByName("pass1")[0].style.backgroundColor = "lightgreen";
                document.getElementById("left").innerHTML = "";
                msgpass1 = p1;
            }
        }

        function checkFname()
        {

            var x = document.getElementsByName("firstname")[0].value;
            if (x == null || x == "") {
                document.getElementsByName("firstname")[0].style.backgroundColor = "red";
                msgfname = "Firstname should be filled out";
                document.getElementById("left").innerHTML = msgfname;
            } else if (x.length < 3) {
                
                document.getElementsByName("firstname")[0].style.backgroundColor = "red";
                msgfname = "Firstname should more than two characters";
                document.getElementById("left").innerHTML = msgfname;
            } else {
                document.getElementsByName("firstname")[0].style.backgroundColor = "lightgreen";
               
                document.getElementById("left").innerHTML = "";
                msgfname = x;
            }
        }
        function checkLname()
        {

            var x = document.getElementsByName("lastname")[0].value;
            if (x == null || x == "") {
                document.getElementsByName("lastname")[0].style.backgroundColor = "red";
             
                msglname = "Lastname should be filled out";
                document.getElementById("left").innerHTML = msglname;
            } else if (x.length < 3) {
                document.getElementsByName("lastname")[0].style.backgroundColor = "red";
               
                msglname = "Lastname should more than two characters";
                document.getElementById("left").innerHTML = msglname;
            } else {
                
                document.getElementsByName("lastname")[0].style.backgroundColor = "lightgreen";
                document.getElementById("left").innerHTML = "";
                msglname = x;
            }
        }

        function checkUname()
        {

            var x = document.getElementsByName("username")[0].value;
            if (x == null || x == "") {
                document.getElementsByName("username")[0].style.backgroundColor = "red";
               
                msglname = "Username should be filled out";
                document.getElementById("left").innerHTML = msglname;
            } else if (x.length < 3) {
                document.getElementsByName("username")[0].style.backgroundColor = "red";

                msglname = "Username should more than two characters";
                document.getElementById("left").innerHTML = msglname;
            } else {
                document.getElementsByName("username")[0].style.backgroundColor = "lightgreen";
                document.getElementById("left").innerHTML = "";
                msglname = x;
            }
        }

        function checkEmail()
        {

            mail = document.getElementsByName("email")[0].value;
            valid = document.getElementsByName("email")[0].getAttribute("pattern");
            if (mail == null || mail == ""){
                msgmail = "Email Address is Required";
                document.getElementById("left").innerHTML = msgmail;
                document.getElementsByName("email")[0].style.backgroundColor = "red";
                
            } else if (mail.search(valid) == -1)
            {
                msgmail = "Invalid Email Address";
                document.getElementById("left").innerHTML = msgmail;
                document.getElementsByName("email")[0].style.backgroundColor = "red";
                
            } else {
                document.getElementById("left").innerHTML = "";
                document.getElementsByName("email")[0].style.backgroundColor = "lightgreen";
                msgmail = mail;
            }
        }

        function checkPass()
        {
            p1 = document.getElementsByName("pass1")[0].value;
            p2 = document.getElementsByName("pass2")[0].value;
            if (p2 == null || p2 == ""){
                msgpass2 = "Password Confirmation is Required";
                document.getElementById("left").innerHTML = msgpass2;
                msgpass = msgpass2;
                document.getElementsByName("pass2")[0].style.backgroundColor = "red";
               
            } else if (p1.search(p2) == -1)
            {
                msgpass = "Password dont match";
                document.getElementById("left").innerHTML = msgpass;
                document.getElementsByName("pass1")[0].style.backgroundColor = "red";
                document.getElementsByName("pass2")[0].style.backgroundColor = "red";
                
            } else {
                document.getElementById("left").innerHTML = "";
                document.getElementsByName("pass2")[0].style.backgroundColor = "lightgreen";
                msgpass = "Password Match";
            }
        }

    </script>

    <div class="container">
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#login" class="active">Login</a>
                </li>
                <li>
                    <a href="#register">Register</a>
                </li>
            </ul>
            <div id="login" class="form-action show">
                <h1>Login</h1>
                
                <form method="post" action="index.php" name="login">
                    <ul>
                        <li>
                            <input type="text" placeholder="Username" name="username"/>
                        </li>
                        <li>
                            <input type="password" placeholder="Password" name="password"/>
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Login" class="button" />
                        </li>
                    </ul>
                    <span id="spa" class="chkadd">Admin Login</span><input class="chkadd" type="checkbox" name="admin" value="admin" />
                </form>
            </div>
            <!--/#login.form-action-->
            <div id="register" class="form-action hide">
                <h1>Register</h1>
                
                <form method="post" 
                      action="registration.php"
                      name="registration form">
                    <ul>
						<li>
                            <input type="text" placeholder="Firstname" name="firstname" onfocus="focusFunc('firstname')" onblur="checkFname()" required/>
                        </li>
						<li>
                            <input type="text" placeholder="Lastname" name="lastname" onfocus="focusFunc('lastname')" onblur="checkLname()" required/>
                        </li>
                        <li>
                            <input type="text" placeholder="Username" name="username" onfocus="focusFunc('username')" onblur="checkUname()" required/>
                        </li>
						<li>
                            <input type="text" placeholder="E-mail" name="email" onfocus="focusFunc('email')" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required onblur="checkEmail()" />
                        </li>
                        <li>
                            <input type="password" placeholder="Password"  name="pass1" onfocus="focusFunc('pass1')" onblur="checkPass1()" required/>
                        </li>
						<li>
                            <input type="password" placeholder="Confirm Password" name="pass2" onfocus="focusFunc('pass2')" onblur="checkPass()"required/>
                        </li>
                        <li>
                            <input type="submit" name="register" value="Register" class="button" />
                        </li>
                    </ul>
                </form>
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
