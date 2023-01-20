<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include_once '../assets/conn/dbconnect.php';

    $hospitalId=$_POST['hno'];
    $password=$_POST['pass'];
    $name=$_POST['hname'];
    $accreditation=$_POST['accreditation'];
    $address=$_POST['address'];
    $state=$_POST['state'];
    $district=$_POST['district'];
    $type=$_POST['hctype'];
    $town=$_POST['town'];
    $pincode=$_POST['pincode'];
    $phone=$_POST['phone'];
    $mobile=$_POST['mobile'];
    $ambulance=$_POST['ambulance'];
    $helpline=$_POST['helpline'];
    $website=$_POST['website'];
    $email=$_POST['email'];
    // $filename = $_FILES["pimage"]["name"];
	// $tempname = $_FILES["pimage"]["tmp_name"];
	// $folder = "img/".$filename;
    $sql = "INSERT INTO `hospital` (`Password`,`Reg_no`, `Hospital_Name`,`Accreditation`,`type`, `Address`, `State`, `District`, `Town`,`Pincode`,`Telephone_no`, `Mobile_no`,`Ambulance_no`,`helpline_no`,`Email`,`Website`)
    VALUES ('$password' ,'$hospitalId', '$name','$accreditation','$type','$address','$state','$district','$town','$pincode','$phone','$mobile','$ambulance','$helpline','$email','$website') ";
    $result = mysqli_query($con, $sql);
    $sql2 = "INSERT INTO `hospital2` (`hospitalId`) VALUES ('$hospitalId') ";
    $result2 = mysqli_query($con, $sql2);
    if($result){
    // move_uploaded_file($tempname, $folder);
    $showAlert = true;
    header("Location: /rakshak/hospital/index.php");
    exit();
    }
}
