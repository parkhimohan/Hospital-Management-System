<?php 
require_once('functions/api.php');
if(@$_POST['update_doctor'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $doc_charge = $_POST["doc_charge"];
    $hid = $_POST["hid"];
    $res=$api->update_doctor(@$_POST['name'],@$_POST['phone'],@$_POST['doc_charge'],@$_POST['hid']);
    if("$res" == "yes")
    {
        echo "<script> window.alert('doctor details updated'); </script>";
    }
    else
    {
        echo "<script> window.alert('doctor does not exist'); </script>";
    }
}
if(@$_POST['delete_doctor'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $phone = $_POST["phone"];
    $res=$api->delete_doctor(@$_POST['name'],@$_POST['email'],@$_POST['pwd'],@$_POST['phone']);
    if("$res" == "yes")
    {
        echo "<script> window.alert('doctor details deleted'); </script>";
        echo "<script> window.location.href = 'index.php'; </script>";
    }
    else
    {
       echo "<script> window.alert('no such doctor exists'); </script>";
    }
}
if(@$_POST['doctor_find_patients'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $res=$api->doctor_find_patients(@$_POST['name'],@$_POST['phone']);
    /*$ids = array();
        if($res->num_rows > 0){
            echo "<table>";
            while($data=$res->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['patientid'];
                echo "</td> <td>";
                echo $data['name'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }*/
}
?>
<html>
    <body>
        <form method = "POST" action="">
            UPDATE DOCTOR DETAILS: <br>
            Name: <input type="text" name="name" id="name" required><br>
            Phone: <input type="text" name="phone" id="phone" required><br>
            Doctor Charge: <input type="number" name="doc_charge" id="doc_charge" required><br>
            Hospital ID: <input type="number" name="hid" id="hid" required><br>
            <input type="submit" name="update_doctor" value="UPDATE">
        </form>
        <form method = "POST" action="">
            DELETE ACCOUNT: <br>
            Name: <input type="text" name="name" id="name" required><br>
            Email: <input type="email" name="email" id="email" required><br>
            Password: <input type="password" name="pwd" id="pwd" required><br>
            Phone: <input type="text" name="phone" id="phone" required><br>
            <input type="submit" name="delete_doctor" value="DELETE ACCOUNT">
        </form>
        <form method = "POST" action="">
            TO VIEW PATIENTS LIST: <br>
            Name: <input type="text" name="name" id="name" required><br>
            Phone: <input type="text" name="phone" id="phone" required><br>
            <input type="submit" name="doctor_find_patients" value="FIND PATIENT">
        </form>
    </body>
</html>
