<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['search_result'])) {

    $query_res = $_SESSION['search_result'];
    unset($_SESSION['search_result']);
}
?>
<?php

// if user is already logged in
if (!isset($_SESSION['logged'])) {
    header("Location: " . URL . "views/site/LogIn.php");
    exit;
}
if ($_SESSION['logged']['is_admin'] == "0") {
    header("Location: " . URL . "views/site/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by Specs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../public/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/animate.css">

    <link rel="stylesheet" href="../../public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../public/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../public/css/magnific-popup.css">

    <link rel="stylesheet" href="../../public/css/aos.css">

    <link rel="stylesheet" href="../../public/css/ionicons.min.css">

    <link rel="stylesheet" href="../../public/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../public/css/jquery.timepicker.css">


    <link rel="stylesheet" href="../../public/css/flaticon.css">
    <link rel="stylesheet" href="../../public/css/icomoon.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <style type="text/css">
        a:link {
            color: rgb(34, 34, 34);
            background-color: transparent;
            text-decoration: none;
        }

        a:hover {
            color: rgb(196, 207, 212);
            background-color: transparent;
            text-decoration: underline;
        }

        .sign {
            width: 104%;
        }

        .gender {
            width: 30%;
            color: rgb(15, 0, 0);

        }

        .un {
            width: 76%;
            color: rgb(15, 0, 0);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgb(236, 236, 236);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(255, 255, 255, 0.02);
            margin-bottom: 50px;
            margin-left: 46px;
            text-align: center;
            margin-bottom: 27px;
            font-family: 'Ubuntu', sans-serif;
        }

        form.form1 {
            padding-top: 40px;
        }


        .submit {
            cursor: pointer;
            border-radius: 5em;
            color: rgb(255, 255, 255);
            background: #000e11;
            border: 0;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 10px;
            padding-top: 10px;
            font-family: 'Ubuntu', sans-serif;
            margin-left: 45%;
            font-size: 13px;
            box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
        }

        .forgot {
            width: 104%;
            padding-top: 15px;
        }
    </style>
    <script>
        function validateForm1() {
            var year = document.forms["myform1"]["year"].value;
            var lower_price = document.forms["myform1"]["lower_price"].value;
            var upper_price = document.forms["myform1"]["upper_price"].value;

            if (year > 0 || year < 10000) {

            } else {
                alert("year must be a valid number");
                return false;
            }
            if (lower_price > 0 || lower_price < 1000000) {

            } else {
                alert("lower price must be a valid number");
                return false;
            }
            if (upper_price > 0 || upper_price < 1000000) {

            } else {
                alert("upper price must be a valid number");
                return false;
            }
            return true;
        }
    </script>
</head>

<!-- 



    Very important note!!
    1. There must be a validation for input data in the form (Front-end)
    2. Placeholder="Any" just a place holder not a text
    3. Fields are not required to be filled


    

    -->

<body>


    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="../site/index.php">Hot<span>Wheels</span></a>
            <!-- AHEZ -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="../site/index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="../site/about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="../site/services.php" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="../site/car.php" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="../site/contact.php" class="nav-link">Contact</a></li>
                    <?php
                    if (isset($_SESSION['logged'])) {

                    ?>
                        <li class="nav-item">
                            <a href="../user/Welcome_User.php" class="nav-link"><strong>Hello
                                    <?= $_SESSION['logged']['full_name'] ?></strong></a>

                        </li>
                        <li class="nav-item"><a href=" <?= URL . "handlers/auth/logout.php"; ?>" class="nav-link">Sign
                                out</a></li>
                        <?php
                        if ($_SESSION['logged']['is_admin'] == "1") {
                        ?>
                            <li class="nav-item"><a href="<?= URL . "views/admin/admin.php" ?>" class=" nav-link">To Admin
                                    Panel</a></li>
                        <?php
                        }

                        ?>

                    <?php
                    } else {
                    ?>
                        <li class="nav-item"><a href="../site/LogIn.php" class="nav-link">Log in</a></li>
                        <li class="nav-item"><a href="../site/SignUp.php" class="nav-link">Sign Up</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../../public/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">

        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <h2 class="mb-3">Advanced Search</h2>
                    <div class="card-body">
                        <?php require_once PATH . "views/inc/messages.php" ?>
                        <form class="form1" name="myform1" id="myform1" action="<?= URL . "handlers/admin/search.php"; ?>" method="POST" onsubmit="return validateForm1();">
                            <h3>By User</h3>
                            <div>
                                <label>User id: </label>
                                <input type="text" name="user_id" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>First name: </label>
                                <input type="text" name="fname" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>Last name: </label>
                                <input type="text" name="lname" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>email: </label>
                                <input type="text" name="email" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label for="html">Birth date Range is from:</label>
                                <input type="date" name="lower_bdate" id="lower_bdate" placeholder="Start Date" value="1930-01-01" required>
                                <label for="html">To:</label>
                                <input type="date" name="upper_bdate" id="upper_bdate" placeholder="End Date" value="2022-12-31" required>
                            </div>
                            <br>
                            <div>
                                <label>gender: </label>
                                <select name="gender" id="gender">
                                    <option value="Both">Both</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <label>country: </label>
                                <input type="text" name="country" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>city: </label>
                                <input type="text" name="city" placeholder="Any">
                            </div>
                            <br>
                            <h3>By Car</h3>
                            <div>
                                <label>brand: </label>
                                <input type="text" name="brand" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>model: </label>
                                <input type="text" name="model" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>body: </label>
                                <input type="text" name="body" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>color: </label>
                                <input type="text" name="color" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>year: </label>
                                <input type="text" name="year" placeholder="Any">
                            </div>
                            <br>
                            <div>
                                <label>price_per_day is from</label>
                                <input type="text" name="lower_price" placeholder="Any">
                                <label>to</label>
                                <input type="text" name="upper_price" placeholder="Any">
                            </div>
                            <br>
                            <h3>By Reservation day</h3>
                            <div>
                                <label for="html">Date Range is from:</label>
                                <input type="date" name="lower_date" id="plate_id" placeholder="Start Date" value="1990-01-01" required>
                                <label for="html">To:</label>
                                <input type="date" name="upper_date" id="brand" placeholder="End Date" value="2030-12-31" required>
                            </div>
                            <br>
                            <input class="submit" type="submit" name="submit" value="submit"><br><br>
                        </form>
                        <?php
                        if (isset($query_res)) {
                            // print_r($query_res);
                            // unset($query_res);
                        ?>
                            <table class="table table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <!-- by user -->
                                        <th scope="col">user_id</th>
                                        <th scope="col">fname</th>
                                        <th scope="col">lname</th>
                                        <th scope="col">email</th>
                                        <th scope="col">balance</th>
                                        <th scope="col">bdate</th>
                                        <th scope="col">gender</th>
                                        <th scope="col">country</th>
                                        <th scope="col">city</th>

                                        <!-- by car -->
                                        <th scope="col">plate_id</th>
                                        <th scope="col">brand</th>
                                        <th scope="col" class="text-center">Car Image</th>
                                        <th scope="col">model</th>
                                        <th scope="col">body</th>
                                        <th scope="col">color</th>
                                        <th scope="col">year</th>
                                        <th scope="col"> price_per_day </th>

                                        <!-- by reservation -->
                                        <th scope="col">reservation_id</th>
                                        <th scope="col">reservation_date</th>
                                        <th scope="col">pick_up_date</th>
                                        <th scope="col">return_date</th>
                                        <th scope="col">payment</th>

                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    <?php
                                    foreach ($query_res as  $car) {
                                    ?>
                                        <tr>
                                            <!-- by user -->
                                            <td> <?php echo $car["user_id"] ?></td>
                                            <td> <?php echo $car["fname"] ?></td>
                                            <td> <?php echo $car["lname"] ?></td>
                                            <td> <?php echo $car["email"] ?></td>
                                            <td> <?php echo $car["balance"] ?></td>
                                            <td> <?php echo $car["bdate"] ?></td>
                                            <td> <?php echo $car["gender"] ?></td>
                                            <td> <?php echo $car["country"] ?></td>
                                            <td> <?php echo $car["city"] ?></td>

                                            <!-- by car -->
                                            <td> <?php echo $car["plate_id"] ?></td>
                                            <td> <?php echo $car["brand"] ?></td>
                                            <td width="300px"> <img style="  height: 50%; width: 50%;" src="<?= URL . "uploads/images/cars/" . $car['plate_id'] . ".jpg" ?>" alt="Car of The Image"></td>
                                            <td> <?php echo $car["model"] ?></td>
                                            <td> <?php echo $car["body"] ?></td>
                                            <td> <?php echo $car["color"] ?></td>
                                            <td> <?php echo $car["year"] ?></td>
                                            <td> <?php echo $car["price_per_day"] ?></td>

                                            <!-- by reservation -->
                                            <td> <?php echo $car["reservation_id"] ?></td>
                                            <td> <?php echo $car["reservation_date"] ?></td>
                                            <td> <?php echo $car["pick_up_date"] ?></td>
                                            <td> <?php echo $car["return_date"] ?></td>
                                            <td> <?php echo $car["payment"] ?></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>


                </div>
            </div>
    </section> <!-- .section -->

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="#" class="logo">Hot<span>Wheels</span></a></h2>
                        <p>A small new car rent office which provide multiple types of car to rent starting from low end
                            to high end and luxurious cars .</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="https://twitter.com/login"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.facebook.com/"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.instagram.com/"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">203 Fawzy Moaz, Smouha,
                                        Alexandria, Egypt</span></li>
                                <li><a href="tel://+20 0106
                                            820 8828"><span class="icon icon-phone"></span><span class="text">+20 0106
                                            820 8828</span></a></li>
                                <li><a href="https://mail.google.com/"><span class="icon icon-envelope"></span><span class="text">Hotwheels@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                </div>
            </div>
    </footer>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>



    <script src="../../public/js/jquery.min.js"></script>
    <script src="../../public/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../../public/js/popper.min.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/jquery.easing.1.3.js"></script>
    <script src="../../public/js/jquery.waypoints.min.js"></script>
    <script src="../../public/js/jquery.stellar.min.js"></script>
    <script src="../../public/js/owl.carousel.min.js"></script>
    <script src="../../public/js/jquery.magnific-popup.min.js"></script>
    <script src="../../public/js/aos.js"></script>
    <script src="../../public/js/jquery.animateNumber.min.js"></script>
    <script src="../../public/js/bootstrap-datepicker.js"></script>
    <script src="../../public/js/jquery.timepicker.min.js"></script>
    <script src="../../public/js/scrollax.min.js"></script>
    <script src="../../public/https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="../../public/js/google-map.js"></script>
    <script src="../../public/js/main.js"></script>

</body>

</html>