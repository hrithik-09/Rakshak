<?php
include_once '../assets/conn/dbconnect.php';
include 'functions.php';
$message = '';
if (isset($_POST["login"])) {

  $formdata = array();

  if (empty($_POST["email"])) {
    $message .= '<li>Email Address is required</li>';
  } else {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $message .= '<li>Invalid Email Address</li>';
    } else {
      $formdata['email'] = $_POST['email'];
    }
  }

  if (empty($_POST['pass'])) {
    $message .= '<li>Password is required</li>';
  } else {
    $formdata['pass'] = $_POST['pass'];
  }

  if ($message == '') {
    $data = array(
      ':email'    =>  $formdata['email']
    );

    $query = "
		SELECT * FROM users
        WHERE email = :email
		";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    if ($statement->rowCount() > 0) {
      foreach ($statement->fetchAll() as $row) {
        if ($row['password'] == $formdata['pass']) {
          header('location:rooms.php');
        } else {
          $message = '<li>Wrong Password</li>';
        }
      }
    } else {
      $message = '<li>Wrong Email Address</li>';
    }
  }
} else if (isset($_POST["register"])) {



  $formdata = array();
  $formdata['name'] = $_POST['name'];
  $formdata['email'] = $_POST['email'];
  $formdata['pass'] = $_POST['pass'];
  $formdata['phone'] = $_POST['phone'];
  $formdata['address'] = $_POST['address'];
  $formdata['DOB'] = $_POST['DOB'];
  $formdata['pincode'] = $_POST['pincode'];
  $formdata['cpass'] = $_POST['cpass'];
  if ($formdata['cpass'] == $formdata['pass']) {
    $data = array(
      ':name' => $formdata['name'],
      ':email' => $formdata['email'],
      ':password' => $formdata['pass'],
      ':phone' => $formdata['phone'],
      ':address' => $formdata['address'],
      ':DOB' => $formdata['DOB'],
      ':pincode' => $formdata['pincode']
    );
    $query = "
      INSERT INTO users (id,email,password,name,address,phone_no,DOB,pincode) VALUES (NULL,:email,:password,:name,:address,:phone,:DOB,:pincode);
    ";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    header('location:inc/header_login.php');
    $message = '<li>Registration Successful</li>';
  } else {
    $message = '<li>Passwords do not match</li>';
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visitors hostel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="common.css/comm.css" rel="Stylesheet">
  <style>
    .availability-form {
      margin-top: -50px;
      z-index: 3;
      position: relative;
    }

    @media screen and (max-width:575px) {
      .availability-form {
        margin-top: 0px;
        padding: 0 35px;
      }

    }

    
  </style>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shaodw-sm sticky-top">
    <div class="container-fluid">
      <img src="../img/logo.png" alt="Rakshak" width="150px">
      <pre>  </pre>
      <a class="navbar-brand me-5 fw-bold fs-2 h-font" href="index.php">Rakshak</a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- <li class="nav-item">
            <a class="nav-link active me-2" aria-current="page" href="project.php">Home</a>
          </li> -->
          
          <!-- <li class="nav-item">
            <a class="nav-link me-2" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="about.php">About</a>
          </li> -->
        </ul>
        <form class="d-flex">
          <a href="doctorlogin.php" type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2">
            Login
          </a>
          

        </form>
      </div>
    </div>
  </nav>

 




 
<!-- --------------
-------------- -->
         
            
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  