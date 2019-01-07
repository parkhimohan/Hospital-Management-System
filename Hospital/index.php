<?php
require_once('functions/api.php');
?>
<button onClick="sign_up_patient()"> Sign Up For New Patient</button>
<button onClick="sign_up_doctor()"> Sign Up For New Doctor</button>
<button onClick = "login_patient()"> Login For Patient</button>
<button onClick = "login_doctor()"> Login For Doctor</button>
<button onClick = "nearest_hospital()"> Find the hospital nearest to you</button>
<button onClick = "registered_doctors()"> Registered doctors</button>
<button onClick = "hospitals()"> Hospitals</button>
<script>
    function sign_up_patient(){
        window.location.href = 'signuppatient.php/';
    }
    function sign_up_doctor(){
        window.location.href = 'signupdoctor.php/';
    }
    function login_patient(){
        window.location.href = 'login_patient.php/';
    }
    function login_doctor(){
        window.location.href = 'login_doctor.php/';
    }
    function nearest_hospital(){
        window.location.href = 'nearest_hospital.php/';
    }
    function registered_doctors(){
        window.location.href = 'registered_doctors.php/';
    }
    function hospitals(){
        window.location.href = 'hospital.php/';
    }
</script>