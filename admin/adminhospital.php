<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (!isset($_SESSION['adminSession'])) {
    header("Location: ../index.php");
}
$usersession = $_SESSION['adminSession'];
$res = mysqli_query($con, "SELECT * FROM `admin` WHERE adminId='$usersession'");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<?php

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `hospital` WHERE hospitalId = '$sno'";
    $results = mysqli_query($con, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Welcome Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>


    <!-- Navigation -->
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="admindashboard.php">Welcome
            <?php echo $usersession; ?>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.php">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Home Page
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admindashboard.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admindoctor.php">
                                <span data-feather="user" class="align-text-bottom"></span>
                                Manage doctor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="adminhospital.php">
                                <span data-feather="heart" class="align-text-bottom"></span>
                                Manage Hospital
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="adminpatient.php">
                                <span data-feather="file-plus" class="align-text-bottom"></span>
                                Manage Patient
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>More options</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                            <a class="nav-link" href="admincontact.php">
                                <span data-feather="mail"></span>
                                Messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminquestion.php">
                                <span data-feather="help-circle"></span>
                                Manage Question
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php?logout">
                                <span data-feather="log-out"></span>
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- navigation end -->
            <!-- <div class="container-fluid"> -->


            <!-- Page Heading -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Hospitals</h1>
                </div>
                <!-- Page Heading end-->
                <!-- Appointment list -->
                <h2 class="my-4">Add / Delete hospital(s)</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add hospital</button>
                <div class="modal modal-signin" tabindex="-1" aria-labelledby="signupModalLabel" id="myModal" aria-hidden="true">
                    <div class="modal-dialog" style=" width: 600px;transition: bottom .75s ease-in-out;" role="document">
                        <div class="modal-content rounded-4 shadow">
                            <div class="modal-header p-5 pb-4 border-bottom-0">
                                <h1 class="fw-bold mb-0 fs-2">Hospital Registration Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-5 pt-0">
                                <form action="handleadminhospital.php" method="post">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3" id="hospitalId" name="hospitalId" placeholder="hospitalId/Registration Number" aria-describedby="hospitalId" required>
                                        <label for="hospitalId">hospitalId / Registration Number</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3" id="hospitalName" name="hospitalName" placeholder="Hospital Name" aria-describedby="hospitalFirstName" required>
                                        <label for="hospitalName">Hospital Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3" id="hospitalAddress" name="hospitalAddress" placeholder="Address" aria-describedby="Address" required>
                                        <label for="hospitalAddress">Address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control rounded-3" id="hospitalPhone" name="hospitalContact" placeholder="name@example.com" aria-describedby="phone" required>
                                        <label for="hospitalContact">Phone No. </label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control rounded-3" id="hospitalEmail" name="hospitalEmail" placeholder="name@example.com" aria-describedby="hospitalEmail" required>
                                        <label for="hospitalEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="Password">
                                        <label for="password">Password</label>
                                    </div>
                                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br /><br />
                <div class="table-responsive">
                    <!-- Table -->
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="filters">
                                <th>hospital Id</th>
                                <th>Name</th>
                                <th>Phone No.</th>
                                <th>Email Id</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM hospital");
                        while ($hospital = mysqli_fetch_array($result)) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $hospital['hospitalId'] . "</td>";
                            echo "<td>" . $hospital['hospitalName'] . "</td>";
                            echo "<td>" . $hospital['hospitalContact'] . "</td>";
                            echo "<td>" . $hospital['hospitalEmail'] . "</td>";
                            echo "<td class='text-center'><a href='adminhospital.php?delete=" . $hospital['hospitalId'] . "'id='d" . $hospital['hospitalId'] . "' class='delete'><span  data-feather='trash' aria-hidden='true'></span></a></td>";
                        }
                        echo "</tr>";
                        echo "</tbody>";
                        ?>
                </div>
            </main>
        </div>

    </div>
    <!-- Bootstrap Core JavaScript -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
        </script> -->
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="dashboard.js"></script>
    </script>
</body>

</html>