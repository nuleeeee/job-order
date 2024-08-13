<?php
session_start();
if (isset($_SESSION['login_user']) && $_SESSION['login_name'] == true) {
 
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBD • Job Order</title>

    <!-- Bootstrap 5.2 -->
    <link href="stylesheets/css/bootstrap.min.css" rel="stylesheet">
    <script src="stylesheets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="stylesheets/css/bootstrap-icons-1.10.5/font/bootstrap-icons.css">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="stylesheets/css/jquery.datatables.min.css">
    <link href="stylesheets/css/buttons.datatables.min.css" rel="stylesheet" type="text/css">

    <!-- JQuery -->
    <script type="text/javascript" src="stylesheets/js/jquery-3.7.0.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="stylesheets/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/mbd_logo.ico">
    <link rel="stylesheet" href="stylesheets/styles.css">

    <!-- Data Tables Min -->
    <script type="text/javascript" charset="utf8" src="stylesheets/js/jquery.datatables.min.js"></script>
    <script src="stylesheets/js/datatables.buttons.min.js"></script>
    <script src="stylesheets/js/jszip.min.js"></script>
    <script src="stylesheets/js/pdfmake.min.js"></script>
    <script src="stylesheets/js/vfs_fonts.js"></script>
    <script src="stylesheets/js/buttons.html5.min.js"></script>

    <!-- Alertify JS -->
    <link rel=" stylesheet" href="stylesheets/css/alertify.min.css" />
    <link rel="stylesheet" href="stylesheets/css/bootstrap.rtl.min.css" />

    <!-- SELECT2 -->
    <link rel="stylesheet" href="stylesheets/css/select2.min.css" />
    <script src="stylesheets/js/select2.min.js"></script>

    <!-- Chart -->
    <script src="stylesheets/js/loader.js"></script>
    <script src="stylesheets/js/html2canvas.min.js"></script>

    <!-- Excel -->
    <script src="stylesheets/js/xlsx.full.min.js"></script>
</head>
<body>


    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- LOGO -->
            <a class="navbar-brand ml-20px" href="index.php">
                <img src="assets/image2.PNG" height="40" alt="MBD-Logo"/>
            </a>
	 <ul class="navbar-nav ms-auto d-flex flex-row avatar">
                <!-- Avatar -->
                <li class="nav-item dropdown">
          
                    <div class="brand-text">
                    <span class="brand-subtitle">Employee Name: <span id="userlogged"><?php  echo  $_SESSION['login_name'];  ?></span><br>

                    
                </div>

                  
                </li>
            </ul>

            <button class="navbar-toggler mr-20px" type="button" data-toggle="collapse" data-target="#OpenNavbar" aria-controls="OpenNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="OpenNavbar">
                <!-- BUTTONS -->
                <div class="navbar-nav ms-auto d-flex flex-row flex-column mr-20px">
                    <ul class="navbar-nav mr-auto mt-2">
                        <li><a class="active" aria-current="true"></a></li>
                        <li class="text-center mr-10">
                            <a class="pointer li-active fa-solid fa-lg bi bi-wrench-adjustable-circle" id="link_truck"  href="truckrepairnav.php">
                                <span class="span-label">Job Order</span>
                            </a>
                        </li>
                        <li class="text-center mr-10">
                            <a class="pointer li-active fa-solid fa-lg bi bi-box-arrow-left" id="link_logout" href="logout.php">
                                <span class="span-label">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->


    <!-- MODALS -->
    <!-- Modal Session Timeout -->
    <?php include "modalsessiontimeout.php" ?>


    <!--Main layout-->
    <main>
        <div id="masterDiv">
            <div class="timer">

            </div>
        </div>
    </main>
    <!--Main layout-->


    <!-- MODALS -->
    <div class="modal fade" id="NewModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">

                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="submitBtn">
                        <strong>Submit</strong>
                        <span class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- Session Timeout -->
    <script src="js/sessiontimeout.js"></script>


    <script>

	 
 readfilesphp("truckrepair/jo_creation.php");


        $("#link_truck").click(function(e) {
            readfilesphp("truckrepair/truckrepairnav.php");
        });
        
        $("#link_dtr").click(function(e) {
            readfilesphp("dtr/dtr_rep.php");
        });

        $("#link_po").click(function(e) {
            readfilesphp("po/po_rqhis.php");
        });
        

        function readfilesphp(url) {
            datas = "";
            $.get(url, function(data) {
                $("#masterDiv").html(data);
            });
        }

        // FOR THE ACTIVE CLASS
        $("a").click(function(event) {
            if (!$(this).hasClass("navbar-brand") && !$(this).hasClass("nav-link")) {
                $("a").removeClass("active");
                $(this).addClass("active");
            }
        });

        $(document).ready(function() {
            $(".navbar-toggler").click(function() {
                $("#OpenNavbar").toggleClass("show");
            });
        });
        
    </script>

</body>

</html>