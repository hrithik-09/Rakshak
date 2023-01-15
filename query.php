<?php
include_once 'assets/conn/dbconnect.php';
?>
<?php
session_start();
if (isset($_SESSION['patientSession'])) {
    header("Location: patient/query.php");
}
else {
    header("Location: index.php?qwlgn=true");
}
?>