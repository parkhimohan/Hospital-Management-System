<?php 
require_once('functions/api.php');
if(@$_POST['update_patient'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $weight = $_POST["weight"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $res=$api->update_patient(@$_POST['name'],@$_POST['weight'],@$_POST['age'],@$_POST['phone']);
    if("$res" == "patient already exists")
    {
        echo "Patient Already Exists";   
    }
    else
    {
       echo "<script> window.alert('patient does not exist'); </script>";
       //echo "<script> window.location.href = 'patient.php'; </script>";
    }
}
if(@$_POST['delete_patient'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $phone = $_POST["phone"];
    $res=$api->delete_patient(@$_POST['name'],@$_POST['email'],@$_POST['pwd'],@$_POST['phone']);
    if("$res" == "yes")
    {
        echo "<script> window.alert('patient details deleted'); </script>";
        echo "<script> window.location.href = 'index.php'; </script>";
    }
    else
    {
       echo "<script> window.alert('patient does not exist'); </script>";
    }
}
if(@$_POST['find_medicine'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $res=$api->find_medicine(@$_POST['name']);
        if("$res" == "No such patient exists")
    {
        echo "No such patient exists";   
    }
    else
    {
       //echo "<script> window.alert('pa'); </script>";
       //echo "<script> window.location.href = 'index.php'; </script>";
    }
}
if(@$_POST['check_days'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $hname = $_POST["hname"];
    $haddress = $_POST["haddress"];
    $hcity = $_POST["hcity"];
    $res=$api->check_days(@$_POST['name'],@$_POST['hname'],@$_POST['haddress'],@$_POST['hcity']);

    if("$res" == "patient already exists")
    {
        echo "Patient Already Exists";   
    }
    else
    {
       //echo "<script> window.alert('pa'); </script>";
       //echo "<script> window.location.href = 'index.php'; </script>";
    }

}
?>

<html>
    <body>
        <form method = "POST" action="">
            UPDATE INFORMATION: <br>
            Name: <input type="text" name="name" id="name" required><br>
            Weight: <input type="number" name="weight" id="weight" required><br>
            Age: <input type="number" name="age" id="age" required><br>
            Phone: <input type="text" name="phone" id="phone" required><br>
            <input type="submit" name="update_patient" value="UPDATE">
        </form>
        <form method = "POST" action="">
            DELETE ACCOUNT: <br>
            Name: <input type="text" name="name" id="name" required><br>
            Email: <input type="email" name="email" id="email" required><br>
            Password: <input type="password" name="pwd" id="pwd" required><br>
            Phone: <input type="text" name="phone" id="phone" required><br>
            <input type="submit" name="delete_patient" value="DELETE ACCOUNT">
        </form>
        <form method = "POST" action="">
            NUMBER OF DAYS PATIENT HAS BEEN ADMITTED AS INPATIENT: <br>
            Patient Name: <input type="text" name="name" id="name" required><br>
            Hospital Name: <input type="text" name="hname" id="hname" required><br>
            Hospital Address: <input type="text" name="haddress" id="haddress" required><br>
            Hospital City: <input type="text" name="hcity" id="hcity" required><br>
            <input type="submit" name="check_days" value="CHECK DAYS">
        </form>
        <form method = "POST" action="">
            VIEW DOCTOR AND MEDICINE DETAILS OF PATIENT: <br>
            Patient Name: <input type="text" name="name" id="name" required><br>
            <input type="submit" name="find_medicine" value="FIND MEDICINE">
        </form>
    </body>
</html>
