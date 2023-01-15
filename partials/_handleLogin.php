<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    $sql = "SELECT * FROM `patient` where patientEmail='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['icPatient'];
            $_SESSION['patientSession'] = $row['icPatient'];
            $_SESSION['useremail'] = $email;
            echo "logged in". $email;
        } 
        header("Location: /rakshak/index.php");  
    }
    else{
        $showError = "Try again with correct credential"; 
        header("Location: /rakshak/index.php?loginsuccess=false&error=$showError"); 
    }
    }
?>