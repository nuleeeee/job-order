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
    <title>MCORE-ADMIN</title>
    
    <!-- Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/hricon.png">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/printStyle.css">

    <!-- Data Tables Min -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>


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


    <!--Main layout-->
    <main>
        <div id="masterDiv">

        </div>
    </main>
    <!--Main layout-->


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