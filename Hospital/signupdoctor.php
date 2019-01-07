<?php 
require_once('functions/api.php');
if(@$_POST['sign_up_doctor'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $spec = $_POST["spec"];
    $doc_charge = $_POST["doc_charge"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $hid = $_POST["hid"];
    $res=$api->signupdoctor_credentials(@$_POST['name'],@$_POST['email'],@$_POST['pwd'],@$_POST['spec'],@$_POST['doc_charge'],@$_POST['phone'],@$_POST['gender'], @$_POST['hid']);
    if("$res" == "doctor already exists")
    {
        echo "Doctor Already Exists";   
    }
    else
    {
       echo "<script> window.alert('doctor added'); </script>";
       echo "<script> window.location.href = '../index.php'; </script>";
    }
}
?>

<html>
    <body>
        <form method = "POST" action="">
            Name: <input type="text" name="name" id="name" required><br>
            Email: <input type="email" name="email" id="email" required><br>
            Password: <input type="password" name="pwd" id="pwd" required><br>
            Specialization: <input type="text" name="spec" id="spec" required><br>
            Doctor Charge: <input type="number" name="doc_charge" id="doc_charge" required><br>
            Phone number: <input type="number" name="phone" id="phone" required><br>
            Gender: <input type="text" name="gender" id="gender" required><br>
            Hospital ID: <input type="text" name="hid" id="hid" required><br>
            <input type="submit" name="sign_up_doctor" value="SIGN UP">
        </form>
    </body>
</html>
