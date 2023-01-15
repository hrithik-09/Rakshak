<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Team Members</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            min-height: 87vh;
        }

        #ques {
            min-height: 433px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .background-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        .bg-1 {
            flex: 1;
            background-color: rgb(180, 243, 175);
        }

        .bg-2 {
            flex: 1;
            background-color: rgb(163, 236, 240);
        }

        .about-container {
            width: 85%;
            min-height: 80vh;
            position: absolute;
            background-color: white;
            box-shadow: 24px 24px 30px #6d8dad;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px 40px;
            border-radius: 5px;
        }

        .text-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-direction: column;
            font-size: 22px;
        }

        .text-container h1 {
            font-size: 70px;
            padding: 20px 0px;
        }

        @media screen and (max-width: 1600px) {
            .about-container {
                width: 90%;
            }

            .image-container img {
                width: 400px;
                height: 400px;
            }

            .text-container h1 {
                font-size: 50px;
            }
        }

        @media screen and (max-width: 1100px) {
            .about-container {
                flex-direction: column;
            }

            .image-container img {
                width: 300px;
                height: 300px;
            }

            .text-container {
                align-items: center;
            }
        }
    </style>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php'; ?>
    <div class="wrapper">

        <div class="background-container">
            <div class="bg-1"></div>
            <div class="bg-2"></div>

        </div>
        <div class="about-container">
            <h1>Meet the team :-</h1>
            
            <h5 class="text-muted">Click on the image to know more.</h5>
            <br>
            <div class="text-container">
                <span class="border"></span>
                <div class="ps">
                    <a href="#p1"><img src="1.jpg" alt=""></a>
                    <a href="#p2"><img src="2.jpg" alt=""></a>
                    <a href="#p3"><img src="3.jpg" alt=""></a>
                </div>
                <div class="section" id="p1">
                    <span class="name">Kanchandeep Kaur</span>
                    <p align="center">
                        Contribution : Frontend Development
                    </p>
                </div>
                <div class="section" id="p2">
                    <span class="name">Hrithik Ranjan</span>
                    <p align="center">
                        Contribution : Frontend and Backend development
                    </p>
                </div>
                <div class="section" id="p3">
                    <span class="name">Himanshu Ranjan</span>
                    <p align="center">
                        Contribution : Frontend development
                    </p>
                </div>
            </div>

        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>