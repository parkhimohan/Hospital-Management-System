<?php 
require_once('functions/api.php');
if(@$_POST['login']){
    //echo @$_POST['email'],@$_POST['password'];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $result = $api->login_credentials(@$_POST['email'], @$_POST['pwd']);
    if($result){
        echo "<script> window.location.href = '../patient.php'; </script>";
        //echo "<b>valid Login Credentials</b>";
        //window.location.href = '../hospital/home.php/';
    }
    else{
        echo "<b>Invalid Login Credentials</b>";
    }
}
?>

<html>
<body>
        <form method = "POST" action="">
            Email : <input type="email" name="email" id="email"><br>
            Password : <input type="password" name="pwd" id="pwd"><br>
            <input type="submit" name="login" value="LOGIN">
        </form>
    </body>
</html>