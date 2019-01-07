<html>
<body>
	<form method = "POST" action="">
            VIEW DOCTOR AND HOSPITAL DETAILS OF PATIENT: <br>
            Patient Name: <input type="text" name="name" id="name" required><br>
            <input type="submit" name="find_doc_hos" value="FIND DOC HOS">
        </form>
     <form method = "POST" action="">
            FILL DETAILS OF INPATIENT: <br>
            Patient Id: <input type="number" name="ptid" id="ptid" required><br>
            Doctor Id: <input type="number" name="dcid" id="dcid" required><br>
            Hospital Id: <input type="number" name="hpid" id="hpid" required><br>
            Charge of Doctor: <input type="number" name="chrdt" id="chrdt" required><br>
            Room Number( a three digit number): <input type="number" name="rmnum" id="rmnum" required><br>
            Room type(ac or non-ac): <input type="text" name="rmt" id="rmt" required><br>
            Room Charge(250 or 100): <input type="number" name="rmchr" id="rmchr" required><br>
            Medicine Id: <input type="number" name="mdid" id="mdid" required><br>
            Admitted-date(in YYYY-MM-DD): <input type="text" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" name="adate" id="adate" required><br>
            Discharge-date(in YYYY-MM-DD): <input type="text" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" name="ddate" id="ddate" required><br>
            Diagnosis: <input type="text" name="dgs" id="dgs" required><br>
            <input type="submit" name="add_inpatient" value="Add Inpatient">
        </form>
        <form method = "POST" action="">
            FILL DETAILS OF OUTPATIENT: <br>
            Patient Id: <input type="number" name="ptid" id="ptid" required><br>
            Doctor Id: <input type="number" name="dcid" id="dcid" required><br>
            Charge of Doctor: <input type="number" name="chrdt" id="chrdt" required><br>
            Hospital Id: <input type="number" name="hpid" id="hpid" required><br>
            Appointment-date(in YYYY-MM-DD): <input type="text" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" name="adate" id="adate" required><br>
             Diagnosis: <input type="text" name="dgs" id="dgs" required><br>
            Medicine Id: <input type="number" name="mdid" id="mdid" required><br>
            <input type="submit" name="add_outpatient" value="Add Outpatient">
        </form>
</body>
</html>
<?php 
require_once('functions/api.php');
if(@$_POST['find_doc_hos'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $name = $_POST["name"];
    $res=$api->find_doc_hos(@$_POST['name']);
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
if(@$_POST['add_inpatient'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $ptid = $_POST["ptid"];
    $dcid  = $_POST["dcid"];
    $hpid  = $_POST["hpid"];
    $chrdt  = $_POST["chrdt"];
    $rmnum  = $_POST["rmnum"];
    $rmt  = $_POST["rmt"];
    $rmchr  = $_POST["rmchr"];
    $mdid  = $_POST["mdid"];
    $adate  = $_POST["adate"];
    $ddate  = $_POST["ddate"];
    $dgs  = $_POST["dgs"];

    $res=$api->add_inpatient($_POST["ptid"],$_POST["dcid"],$_POST["hpid"],$_POST["chrdt"],$_POST["rmnum"],$_POST["rmt"],$_POST["rmchr"],$_POST["mdid"],$_POST["adate"],$_POST["ddate"],$_POST["dgs"]);
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
if(@$_POST['add_outpatient'])
{
    //echo @$_POST['email'],@$_POST['password'];
    $ptid = $_POST["ptid"];
    $dcid  = $_POST["dcid"];
    $chrdt  = $_POST["chrdt"]; 
    $hpid  = $_POST["hpid"];   
    $adate  = $_POST["adate"];
    $dgs  = $_POST["dgs"];
    $mdid  = $_POST["mdid"];
   

    $res=$api->add_outpatient($_POST["ptid"],$_POST["dcid"],$_POST["chrdt"],$_POST["hpid"],$_POST["adate"],$_POST["dgs"],$_POST["mdid"]);
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
?>