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
    #home:hover{
      background-color: black;
      color: white;
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
      <img src="assets/img/logo.png" alt="Rakshak" width="150px">
      <pre>  </pre>
      <a class="navbar-brand me-5 fw-bold fs-2 h-font" href="project.php">Rakshak</a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- <li class="nav-item">
            <a class="nav-link active me-2" id="home" aria-current="page" href="project.php">Home</a>
          </li> -->

          <!-- <li class="nav-item">
            <a class="nav-link me-2" href="#contact">Contact Us</a>
          </li>
           -->
        </ul>
        <form class="d-flex">
          <?php
          if(isset($_SESSION['hospitalloggedin']) && $_SESSION['hospitalloggedin']==true){
            echo'
            <a href="patient/patient.php" class="btn btn-outline-dark shadow-none me-lg-3 me-2">'.$_SESSION['hospitalSession'].'</a>';
          }
          else
          echo '<a href="../hospitallogin.php" type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2">Login
          </a>';
          ?>
          <button type="button" class="btn btn-outline-dark shadow-none " data-bs-toggle="modal" data-bs-target="#RegisterModal">
            Register
          </button>

        </form>
      </div>
    </div>
  </nav>

  
  </div>



  <div class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" action="handleadminhospital.php">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-lines-fill"></i>
              <pre> </pre>User Registration
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="badge bg-light text-dark ">
              Note: Kindly provide correct information, as it will be cross-checked by govenment database.
            </span>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Hospital Name</label>
                  <input type="text" name="hname" class="form-control shadow-none">
                </div>
                <br>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Accreditation</label><br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="accreditation" id="inlineRadio1" value="Government">
                    <label class="form-check-label" for="inlineRadio1">Government</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="accreditation" id="inlineRadio2" value="Private">
                    <label class="form-check-label" for="inlineRadio2">Private</label>
                  </div>
                </div>
                <div class="col-md-6 ps-0">
                  <label class="form-label">Health Care Provider Type: </label>
                  <div class="form-check">
                    <input class="form-check-input" name="hctype" type="checkbox" value="Hospital" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      Hospital
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hctype" value="Nursing Home" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck1">
                      Nursing Home
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hctype" value="Medical College" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck3">
                      Medical College/Institute
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hctype" value="Clinic" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck4">
                      Clinic
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hctype" value="Others" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck5">
                      Others
                    </label>
                  </div>
                </div>

                <!-- <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Upload Image</label>
                  <input type="file" name="pimage" class="form-control shadow-none" required>
                </div> -->
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="pass" class="form-control shadow-none" required>
                </div>

                <!-- ----------------- -->

                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Hospital Reg. Number</label>

                  <input type="number" name="hno" class="form-control shadow-none" required>

                </div>
                <!-- ----------------- -->
                <!-- --------------------- -->
                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Hospital Address</label>
                  <input type="text" name="address" class="form-control shadow-none" required>
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">State</label>
                  <input type="text" name="state" class="form-control shadow-none" required>
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">District</label>
                  <input type="text" name="district" class="form-control shadow-none" required>
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Town</label>
                  <input type="text" name="town" class="form-control shadow-none">
                </div>

                

                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Pincode</label>
                  <input type="number" name="pincode" class="form-control shadow-none" required>
                </div>


                <!-- ------------------
                ------------------- -->

                <div class="col-md-6 ps-0">
                  <label class="form-label">Hospital Email</label>
                  <input type="email" name="email" class="form-control shadow-none" required>
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Telephone/Landline Number</label>
                  <input type="number" name="phone" class="form-control shadow-none" required>
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Mobile No.</label>
                  <input type="number" name="mobile" class="form-control shadow-none">
                </div>

                

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Ambulance Phone No.</label>
                  <input type="number" name="ambulance" class="form-control shadow-none">
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Helpline No.</label>
                  <input type="number" name="helpline" class="form-control shadow-none">
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Website</label>
                  <input type="url" name="website" class="form-control shadow-none" placeholder=".com">
                </div>

                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Specialities :</label><br>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="specialities" value="Anaesthesiology" id="defaultCheck6">
                    <label class="form-check-label" for="defaultCheck1">
                      Anaesthesiology
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="specialities" value="Anatomy" id="defaultCheck7">
                    <label class="form-check-label" for="defaultCheck1">
                      Anatomy
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Dental" name="specialities" id="defaultCheck8">
                    <label class="form-check-label" for="defaultCheck1">
                      Dental
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Neurology" name="specialities" id="defaultCheck9">
                    <label class="form-check-label" for="defaultCheck1">
                      Neurology
                    </label>
                  </div>


                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Psychiatry" name="specialities" id="defaultCheck10">
                    <label class="form-check-label" for="defaultCheck1">
                      Psychiatry
                    </label>
                  </div>


                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Pediatrics" name="specialities" id="defaultCheck11">
                    <label class="form-check-label" for="defaultCheck1">
                      Pediatrics
                    </label>
                  </div>


                  <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Kidney Tr" name="specialities" id="defaultCheck12">
                    <label class="form-check-label" for="defaultCheck1">
                      Kidney Transplant
                    </label>
                  </div> -->


                  <div class="form-check">
                    <input class="form-check-input" name="specialities" type="checkbox" value="Cardiology" id="defaultCheck13">
                    <label class="form-check-label" for="defaultCheck1">
                      Cardiology
                    </label>
                  </div>


                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Orthopedics" name="specialities" id="defaultCheck14">
                    <label class="form-check-label" for="defaultCheck1">
                      Orthopedics
                    </label>
                  </div>
                </div>


                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Facilities : </label><br>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="specialities" value="ICU" id="defaultCheck15">
                    <label class="form-check-label" for="defaultCheck1">
                      ICU
                    </label>
                  </div>



                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="OPD" name="specialities" id="defaultCheck16">
                    <label class="form-check-label" for="defaultCheck1">
                      OPD
                    </label>
                  </div>



                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Pharmacy" name="specialities" id="defaultCheck17">
                    <label class="form-check-label" for="defaultCheck1">
                      Pharmacy
                    </label>
                  </div>



                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Ambulance" name="specialities" id="defaultCheck18">
                    <label class="form-check-label" for="defaultCheck1">
                      Ambulance
                    </label>
                  </div>




                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Blood Bank" name="specialities" id="defaultCheck19">
                    <label class="form-check-label" for="defaultCheck1">
                      Blood Bank
                    </label>
                  </div>



                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Laboratory" name="specialities" id="defaultCheck20">
                    <label class="form-check-label" for="defaultCheck1">
                      Laboratory
                    </label>
                  </div>



                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Operation Theatre" name="specialities" id="defaultCheck21">
                    <label class="form-check-label" for="defaultCheck1">
                      Operation Theatre
                    </label>
                  </div>
                </div>



                <!-- ------------------
------------------ -->

                
              </div>
            </div>
            </fieldset>

            <div class="text-center my-1">
              <button type="submit" name="register" class="btn btn-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#LoginModal">
                Register
              </button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>