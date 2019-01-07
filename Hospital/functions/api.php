<?php 
require_once("config.php");
session_start();

class API
{

    public function __construct()
    {

		$connect=new Config();

		$this->db=$connect->connection();
				date_default_timezone_set("Asia/Kolkata");

    }

    public function insert_doctor($name,$spec,$charge)
    {
        $result = $this->db->query("INSERT into doctor(name,specialization,doc_charge) values('$name','$spec','$charge')");
        return $result;
    }

    public function add_inpatient( $ptid, $dcid, $hpid, $chrdt, $rmnum, $rmt, $rmchr, $mdid, $adate, $ddate, $dgs)
    {
        $date1 = date("Y-m-d",strtotime($adate));
        $date2 = date("Y-m-d",strtotime($ddate));
        $result = $this->db->query("INSERT into inpatient(pid,did,hospid,doccharge,roomnum,roomtype,roomcharge,mid,indate,outdate,diagnosis) values( '$ptid', '$dcid', '$hpid', '$chrdt', '$rmnum', '$rmt', '$rmchr', '$mdid', '$date1', '$date2', '$dgs')");
        return $result;
    }

    public function add_outpatient( $ptid, $dcid, $chrdt, $hpid, $adate, $dgs, $mdid)
    {
        $date1 = date("Y-m-d",strtotime($adate));
        $result = $this->db->query("INSERT into outpatient(pid,did,doccharge,hospid,`date`,diagnosis,mid) values( '$ptid', '$dcid', '$chrdt', '$hpid', '$date1', '$dgs', '$mdid')");
        return $result;
    }

    public function login_credentials($email, $pwd)
    {
        $result = $this->db->query("SELECT * from login where email='$email' and pwd='$pwd'");
        if ($result->num_rows > 0){
            return TRUE;
        }
        else return FALSE;
    }
    
    public function signuppatient_credentials($name, $email, $pwd, $weight, $age, $gender, $phone)
    {
        $result = $this->db->query("SELECT * from login where email='$email'");
        if ($result->num_rows > 0){
            return "patient already exists";
        }
        else{
            //$result2 = $this->db->query("DELIMITER $$ CREATE TRIGGER 'add_patient' AFTER INSERT ON 'login' FOR EACH ROW INSERT INTO patient(name, weight, age, gender, phone) values('$name', '$weight', '$age', '$gender', '$phnum') $$ DELIMITER");
            $result3 = $this->db->query("INSERT into login(email, pwd) values('$email','$pwd')");
            $result2 = $this->db->query("INSERT into patient(name,weight, age, gender, phone) values('$name','$weight','$age', '$gender', '$phone')");
           
            return $result2;
        }
    }

    public function signupdoctor_credentials($name, $email, $pwd, $spec, $doc_charge, $phone, $gender, $hid)
    {
        $result4 = $this->db->query("SELECT * from login where email='$email'");
        if ($result4->num_rows > 0){
            return "doctor already exists";
        }
        else{
            //$result2 = $this->db->query("DELIMITER $$ CREATE TRIGGER 'add_doctor' AFTER INSERT ON 'login' FOR EACH ROW INSERT INTO doctor(name, specialization, doc_charge) values('$name', '$spec', '$doccharge') $$ DELIMITER");
            $result6 = $this->db->query("INSERT into login(email, pwd) values('$email','$pwd')");
            $result5 = $this->db->query("INSERT into doctor(name, specialization, doc_charge, phone, gender, hid) values('$name','$spec','$doc_charge', '$phone', '$gender', '$hid')");
            return $result5;
        }
    }

    public function nearest_hospital()
    {
        $result7 = $this->db->query("SELECT * from hospital");
        $ids = array();
        if($result7->num_rows > 0){
            while($data=$result7->fetch_assoc()){
                array_push($ids, $data);
                echo $data['hospitalid'], ' ', $data['name'], ' ', $data['address'];
                echo "<br>";
            }
        }
    }

    public function add_hospital($name, $address, $city)
    {
        $result8 = $this->db->query("INSERT into hospital(name, address, city) values('$name', '$address', '$city')");
        return $result8;
    }

    public function update_patient($name, $weight, $age, $phone)
    {
        $result15 = $this->db->query("SELECT name, phone from patient where name='$name' and phone='$phone'");
        if($result15->num_rows > 0){
            //echo $result15;
            $result11 = $this->db->query("UPDATE patient set weight='$weight' where name='$name'");
            $result9 = $this->db->query("UPDATE patient set age='$age' where name='$name'");
            $result10 = $this->db->query("UPDATE patient set phone='$phone' where name='$name'");
            return $result11;
        }
        else echo "Patient does not exist";
    }

    public function delete_patient($name, $email, $pwd, $phone)
    {
        $res = $this->db->query("SELECT name, phone from patient where name='$name' and phone='$phone'");
        if($res->num_rows > 0){
            $res2 = $this->db->query("SELECT * from login where email='$email' and pwd='$pwd'");
            if($res2->num_rows > 0){
                $result12 = $this->db->query("DELETE from patient where name='$name' and phone='$phone'");
                $result13 = $this->db->query("DELETE from login where email='$email' and pwd='$pwd'");
                return "yes";
            }
        }
        return "no";
    }

    public function update_doctor($name, $phone, $doc_charge, $hid)
    {
        $result15 = $this->db->query("SELECT name from doctor where name='$name'");
        if($result15->num_rows > 0){
            $result12 = $this->db->query("UPDATE doctor set phone='$phone' where name='$name'");
            $result13 = $this->db->query("UPDATE doctor set doc_charge='$doc_charge' where name='$name'");
            $result14 = $this->db->query("UPDATE doctor set hid='$hid' where name='$name'");
            return "yes";
        }
        else return "no";
    }

    public function delete_doctor($name, $email, $pwd, $phone)
    {        
        $res = $this->db->query("SELECT name, phone from doctor where name='$name' and phone='$phone'");
        if($res->num_rows > 0){
            $res2 = $this->db->query("SELECT * from login where email='$email' and pwd='$pwd'");
            if($res2->num_rows > 0){
                $result12 = $this->db->query("DELETE from doctor where name='$name' and phone='$phone'");
                $result13 = $this->db->query("DELETE from login where email='$email' and pwd='$pwd'");
                return "yes";
            }
        }
        return "no";
    }

    public function delete_hospital($name, $address, $city)
    {
        $result15 = $this->db->query("SELECT * from hospital where name='$name' and address='$address' and city='$city'");
        if($result15->num_rows > 0){
            $result14 = $this->db->query("DELETE from hospital where name='$name' and address='$address' and city='$city'");
            return "yes";
        }
        else return "no";
    }

    public function visit_pat_year($sdate, $edate, $hname, $haddress, $hcity)
    {
        $date1 = date("Y-m-d",strtotime($sdate));
        $date2 = date("Y-m-d",strtotime($edate));
        //echo $date1, "<br>";
        //echo $date2;
        $result21 = $this->db->query("SELECT patient.name  from outpatient inner join patient on outpatient.pid=patient.patientid where (outpatient.date > '$date1' and outpatient.date < '$date2') and outpatient.hospid=(select hospitalid from hospital where name ='$hname' and address='$haddress' and city='$hcity')");
        $result22 = $this->db->query("SELECT patient.name  from inpatient inner join patient on inpatient.pid=patient.patientid where ((inpatient.indate > '$date1' and inpatient.indate < '$date2') or (inpatient.outdate > '$date1' and inpatient.outdate <'$date2')) and inpatient.hospid=(select hospitalid from hospital where name ='$hname' and address='$haddress' and city='$hcity')");
        $ids = array();
        if($result21->num_rows > 0){
            echo "Outpatients Who Visited $hname between $date1 and $date2:<br>";
            echo "<table>";
            while($data=$result21->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['name'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        echo"<br>";
        } 
        $ids = array(); 
        if($result22->num_rows > 0){
            echo "Inpatients Who Been Admitted At $hname between $date1 and $date2:<br>";
            echo "<table>";
            while($data=$result22->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['name'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        echo"<br><br>";
        }

    }    
   
    public function doctor_find_patients($name, $phone)
    {
       $result16 = $this->db->query("SELECT patient.patientid, patient.name from patient inner join outpatient on patient.patientid=outpatient.pid where outpatient.did=(select doctorid from doctor where name='$name' and phone='$phone')");
       $ids = array();
        if($result16->num_rows > 0){
            echo "OUTPATIENTS LIST OF $name<br>";
            echo "<table>";
            while($data=$result16->fetch_assoc()){
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
        echo"<br><br>";
        }
       $result17 = $this->db->query("SELECT patient.patientid, patient.name from patient inner join inpatient on patient.patientid=inpatient.pid where inpatient.did=(select doctorid from doctor where name='$name' and phone='$phone')");
        $ids = array();
       if($result17->num_rows > 0){
            echo "INPATIENTS LIST OF $name<br>"; 
           echo "<table>";
            while($data=$result17->fetch_assoc()){
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
        echo "<br><br>";
        }
    }

    public function check_days($name, $hname, $haddress, $hcity)
    {
        $result18 = $this->db->query("SELECT datediff(inpatient.outdate, inpatient.indate) as numofdays from inpatient inner join patient on patient.patientid=inpatient.pid where patient.name='$name' and inpatient.hospid in (select hospitalid from hospital where name='$hname' and address='$haddress' and city='$hcity')");

        //create view mee as(SELECT outdate from inpatient where inpatient.pid in (select patientid from patient where name='Irene') and hospid in (select hospitalid from hospital where name='star' and address='t.k.street' and city='delhi'));

        //$ress = $this->db->query("SELECT * from me");
        //$p = $this->db->query("SELECT COUNT(num_of_days) from me");

        $ids = array();
        //$result = $this->db->query("SELECT distinct count(*) from (select datediff(outdate, indate) as num_of_days from inpatient where ((pid=(select patientid from patient where name='$name') and (hospid=(select hospitalid where name='$hname' and address='$haddress' and city='$hcity'))))");
        if($result18->num_rows > 0){
            echo "<table>";
            while($data=$result18->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo "Number Of Days $name Has Been Admitted As Inpatient: ", $data['numofdays'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><br>";
        }
        else{
            echo "is zero";
        }
            
    }

    public function find_medicine($name)
    {
           /* create view find_pat_doc_med as(SELECT patient.name as patient_name,doctor.name as prescribed_by_doctor,inpatient.diagnosis as diagnosis,medicine.mname as medicine_name,medicine.mcharge as medicine_charge,medicine.issueddate as date_issued_on from patient,medicine,doctor,inpatient where patient.patientid=inpatient.pid and doctor.doctorid=inpatient.did and inpatient.mid=medicine.mid); 
            */
            $result23 = $this->db->query("select * from find_pat_doc_med where patient_name='$name'");
            $result24 = $this->db->query("select * from find_pat_doc_med_2 where patient_name='$name'");
            $ids = array();
        //$result = $this->db->query("SELECT distinct count(*) from (select datediff(outdate, indate) as num_of_days from inpatient where ((pid=(select patientid from patient where name='$name') and (hospid=(select hospitalid where name='$hname' and address='$haddress' and city='$hcity'))))");
        if($result23->num_rows > 0){
            echo "Details about medicine and doctor: ";
            echo "<table>";
            while($data=$result23->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['patient_name'];
                echo "</td>";
                echo "<td>";
                echo $data['prescribed_by_doctor'];
                echo "</td>";
                echo "<td>";
                echo $data['diagnosis'];
                echo "</td>";
                echo "<td>";
                echo $data['medicine_name'];
                echo "</td>";
                echo "<td>";
                echo $data['medicine_charge'];
                echo "</td>";
                echo "<td>";
                echo $data['date_issued_on'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><br>";
        }
        else{
           if($result24->num_rows > 0){
            echo "Details about medicine and doctor: ";
            echo "<table>";
            while($data=$result24->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['patient_name'];
                echo "</td>";
                echo "<td>";
                echo $data['prescribed_by_doctor'];
                echo "</td>";
                echo "<td>";
                echo $data['diagnosis'];
                echo "</td>";
                echo "<td>";
                echo $data['medicine_name'];
                echo "</td>";
                echo "<td>";
                echo $data['medicine_charge'];
                echo "</td>";
                echo "<td>";
                echo $data['date_issued_on'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><br>";
        } 
            echo "is zero";
        }

    }

    public function find_doc_hos($name)
    {
           /* create view find_pat_doc_med as(SELECT patient.name as patient_name,doctor.name as prescribed_by_doctor,inpatient.diagnosis as diagnosis,medicine.mname as medicine_name,medicine.mcharge as medicine_charge,medicine.issueddate as date_issued_on from patient,medicine,doctor,inpatient where patient.patientid=inpatient.pid and doctor.doctorid=inpatient.did and inpatient.mid=medicine.mid); 
            */
            $result23 = $this->db->query("select * from outpatient_details where patient_name='$name'");
            $result24 = $this->db->query("select * from inpatient_details where patient_name='$name'");
            $ids = array();
        //$result = $this->db->query("SELECT distinct count(*) from (select datediff(outdate, indate) as num_of_days from inpatient where ((pid=(select patientid from patient where name='$name') and (hospid=(select hospitalid where name='$hname' and address='$haddress' and city='$hcity'))))");
        if($result23->num_rows > 0){
            echo "Details about doctor and hospital: ";
            echo "<table>";
            while($data=$result23->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['patient_name'];
                echo "</td>";
                echo "<td>";
                echo $data['doctor_name'];
                echo "</td>";
                echo "<td>";
                echo $data['hospital_name'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><br>";
        }
        else{
           if($result24->num_rows > 0){
            echo "Details about doctor and hospital: ";
            echo "<table>";
            while($data=$result24->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['patient_name'];
                echo "</td>";
                echo "<td>";
                echo $data['doctor_name'];
                echo "</td>";
                echo "<td>";
                echo $data['hospital_name'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br><br>";
        } 
        }

    }

    public function registered_doctors(){
        $result7 = $this->db->query("SELECT * from doctor");
        $ids = array();
        if($result7->num_rows > 0){
            echo "<table>";
            while($data=$result7->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['doctorid'];
                echo "</td> <td>";
                echo $data['name'];
                echo "</td> <td>";
                echo $data['specialization'];
                echo "</td> <td>";
                echo $data['doc_charge'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    public function admin($email, $pwd){
        //$result7 = $this->db->query("");
        if($email=='admin@hospital.in'){
            if($pwd=='root'){
                echo $email, ' ', $pwd;
                echo "entered";
                //echo <script>window.location.href = 'after_login.php/'</script>;
                echo "<script> window.location.href = '../after_login.php/'</script>";
            }
            else echo "Invalid admin credentials";
        }
        else echo "Invalid admin credentials";
        /*$ids = array();
        if($result7->num_rows > 0){
            echo "<table>";
            while($data=$result7->fetch_assoc()){
                echo "<tr>";
                array_push($ids, $data);
                echo "<td>";
                echo $data['doctorid'];
                echo "</td> <td>";
                echo $data['name'];
                echo "</td> <td>";
                echo $data['specialization'];
                echo "</td> <td>";
                echo $data['doc_charge'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }*/
    }
}
$api = new API();