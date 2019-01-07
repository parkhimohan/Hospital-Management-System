<?php 
require_once('functions/api.php');
if(@$_POST['sign_up_patient'])
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $weight = $_POST["weight"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $res=$api->signuppatient_credentials(@$_POST['name'],@$_POST['email'],@$_POST['pwd'],@$_POST['weight'],@$_POST['age'],@$_POST['gender'],@$_POST['phone']);
    if("$res" == "patient already exists")
    {
        echo "Patient Already Exists";   
    }
    else
    {
       echo "<script> window.alert('patient added'); </script>";
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
            Weight: <input type="number" name="weight" id="weight" required><br>
            Age: <input type="number" name="age" id="age" required><br>
            Gender: <input type="text" name="gender" id="gender" required><br>
            Phone: <input type="text" name="phone" id="phone" required><br>
            <input type="submit" name="sign_up_patient" value="SIGN UP">
        </form>
    </body>
</html>
