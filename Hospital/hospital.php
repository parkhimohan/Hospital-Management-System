<?php 
require_once('functions/api.php');
if(@$_POST['hospital']){
    $name = $_POST["name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $result = $api->add_hospital(@$_POST['name'], @$_POST['address'], @$_POST['city']);
    if($result){
        echo "<script> window.location.href = '../hospitals.php'; </script>";
        //echo "<b>valid Login Credentials</b>";
        //window.location.href = '../hospital/home.php/';
    }
    else{
        echo "<b>Invalid Login Credentials</b>";
    }
}
if(@$_POST['delete_hospital'])
{
    $name = $_POST["name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $res=$api->delete_hospital(@$_POST['name'],@$_POST['address'],@$_POST['city']);
    if("$res" == "no")
    {
        echo "No such hospital exists";   
    }
    else
    {
       echo "<script> window.alert('hospital details deleted'); </script>";
       echo "<script> window.location.href = 'index.php'; </script>";
    }
}
if(@$_POST['visited_pat_year'])
{
    $sdate = $_POST["sdate"];
    //$date1 = date("Y-m-d",strtotime($sdate));
    $edate = $_POST["edate"];
    //$date2 = date("Y-m-d",strtotime($edate));
    $hname = $_POST["hname"];
    $haddress = $_POST["haddress"];
    $hcity = $_POST["hcity"];
    $res=$api->visit_pat_year(@$_POST['sdate'],@$_POST['edate'],@$_POST['hname'],@$_POST['haddress'],@$_POST['hcity']);
}
if(@$_POST['admin'])
{
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $res=$api->admin(@$_POST['email'],@$_POST['pwd']);
}
?>

<html>
<body>
        <form method = "POST" action="after_login.php">
            HOSPITAL ADMIN LOGIN: <br>
            Email: <input type="email" name="email" id="email"><br>
            Password: <input type="password" name="pwd" id="pwd"><br>
            <input type="submit" name="admin" value="ADMIN LOGIN">
        </form>
        <form method = "POST" action="">
            Name: <input type="text" name="name" id="name"><br>
            Address: <input type="text" name="address" id="address"><br>
            City: <input type="text" name="city" id="city"><br>
            <input type="submit" name="hospital" value="ADD HOSPITAL">
        </form>
        <form method = "POST" action="">
            REMOVE HOSPITAL: <br>
            Name: <input type="text" name="name" id="name" required><br>
            Address: <input type="text" name="address" id="address" required><br>
            City: <input type="text" name="city" id="city" required><br>
            <input type="submit" name="delete_hospital" value="REMOVE HOSPITAL">
        </form>
        <form method = "POST" action="">
            VISITED PATIENTS: <br>
            start-date(in YYYY-MM-DD): <input type="text" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" name="sdate" id="sdate" required><br>
            end-date(in YYYY-MM-DD): <input type="text" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" name="edate" id="edate" required><br>
            HName: <input type="text" name="hname" id="hname" required><br>
            HAddress: <input type="text" name="haddress" id="haddress" required><br>
            HCity: <input type="text" name="hcity" id="hcity" required><br>
            <input type="submit" name="visited_pat_year" value="Find visited">
        </form>
        <!-- <form method = "POST" action="">
            LIST OF PATIENTS: <br>
            Date: <input type="text" name="date" id="date" required><br>
            HName: <input type="text" name="hname" id="hname" required><br>
            HAddress: <input type="text" name="haddress" id="haddress" required><br>
            HCity: <input type="text" name="hcity" id="hcity" required><br>
            <input type="submit" name="find_a_day" value="Find patient on a day">
        </form>-->
    </body>
</html>