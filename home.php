<?php
session_start();
if (!isset($_SESSION['login_user'])) {
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-icons-1.10.5/font/bootstrap-icons.css">

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.7.0.js"></script>

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="css/jquery.datatables.min.css">
    <link href='css/buttons.datatables.min.css' rel='stylesheet' type='text/css'>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/hricon.png">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/printStyle.css">

    <!-- SELECT2 -->
    <link rel="stylesheet" href="css/select2.min.css" />
    <script src="js/select2.min.js"></script>

    <!-- Data Tables Min -->
    <script type="text/javascript" charset="utf8" src="js/jquery.datatables.min.js"></script>
    <script type="text/javascript" src="js/datatables.editor.js"></script>
    <script type="text/javascript" src="js/datatables.buttons.min.js"></script>
    <script type="text/javascript" src="js/datatables.select.min.js"></script>
    <script type="text/javascript" src="js/datatables.datetime.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/editor.datatables.min.css">

     <!-- Excel -->
    <script src="js/xlsx.full.min.js"></script>

</head>
<body>

    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="home.php"><img src="assets/image2.png" height="40" alt="MBD-Logo"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideBar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="sideBar">
                    <div class="offcanvas-header">
                        <img src="assets/image2.png" height="40" alt="MBD-Logo"/>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_suppadd">
                                    <img src="assets/icons/person.png" height="30" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Add<br>Supplier</span>
                                </button>
                            </li>
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_truck">
                                    <img src="assets/icons/briefcase.png" height="30" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Job<br>Order</span>
                                </button>
                            </li>
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_rprt">
                                    <img src="assets/icons/pending.png" height="30" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Job<br>Pending</span>
                                </button>
                            </li>
                            <li class="nav-item me-1">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_history">
                                    <img src="assets/icons/service.png" height="30" class="me-2">
                                    <span class="fw-bold lh-1 text-start" style="font-size: 12px;">Truck Repair<br>History</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="menu-button d-flex flex-row align-items-center" id="link_logout">
                                    <img src="assets/icons/logout.png" height="30" class="me-2">
                                    <span class="fw-bold lh-1" style="font-size: 12px;">Logout</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->


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


    <div class='modal fade' id='AddSupplier' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header d-flex justify-content-between'>
                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class='pointer bi bi-arrows-angle-contract' data-bs-dismiss='modal' aria-label='Close' onclick="clearModal()"></i>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <label for='name_addsupplier'>Name</label>
                            <input type='text' id='name_addsupplier' class='form-control' placeholder="Input Name...">
                        </div>
                        <div class='col-sm-6'>
                            <label for='contactno_addsupplier'>Contact Number</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">+63</span>
                                <input type='text' id='contactno_addsupplier' class='form-control' placeholder="9123456789" maxlength="10">
                            </div>
                            <i class="invalidnum text-danger d-none">Invalid Contact Number</i>
                        </div>
                        <div class='col-sm-12'>
                            <label for='address_addsupplier'>Address</label>
                            <input type='text' id='address_addsupplier' class='form-control' placeholder="Input Address...">
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-sm custom-btn' onclick="addSupplier()">Add Supplier</button>
                </div>
            </div>
        </div>
    </div>


    <!-- SUCCESS MODAL -->
    <div class='modal fade' id='successMsgModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-sm'>
            <div class='modal-content'>
                <div class='modal-header bg-success text-light'>
                    <label>Success</label>
                </div>
                <div class='modal-body'>
                    <label>Job Order Sent.</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-sm btn-success' data-bs-dismiss='modal'>Done</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ORDER SENT MODAL -->
    <div class='modal fade' id='ordersentMsgModal' tabindex='-1' data-bs-keyboard="false" data-bs-backdrop="static" aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-sm'>
            <div class='modal-content'>
                <div class='modal-header bg-success text-light'>
                    <label>Success</label>
                </div>
                <div class='modal-body'>
                    <label>Job Order Saved.</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-sm btn-success' data-bs-dismiss='modal' data-bs-toggle="modal" data-bs-target="#SendAsEmail">Send As Email</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ERROR MODAL -->
    <div class='modal fade' id='errorMsgModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-sm'>
            <div class='modal-content'>
                <div class='modal-header bg-danger text-light'>
                    <label>Error</label>
                </div>
                <div class='modal-body'>
                    <label>Please check your inputs.</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>

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

    <input type="text" class="d-none" id="branchid" disabled value="<?php echo $_SESSION['branch']; ?>">


<!-- Session Timeout -->
<script src="js/sessiontimeout.js"></script>


<script>
    var branchid = $('#branchid').val();

    readfilesphp("truckrepair/jo_creation.php");

    $("#link_suppadd").click(function(e) {
        $("#AddSupplier").modal("show");
    });

    $("#link_truck").click(function(e) {
        readfilesphp("truckrepair/jo_creation.php");
    });

    $("#link_rprt").click(function(e) {
        readfilesphp("truckrepair/jo_pending.php");
    });

    $("#link_history").click(function(e) {
        readfilesphp("history/");
    });

    function readfilesphp(url) {
        $.get(url, function(data) {
            $("#masterDiv").html(data);
        });
    }

    // THIS IS THE ACTIVE ON CLICK FUNCTION
    $("#link_truck").addClass("clicked");
    $(".menu-button:not(#link_suppadd)").on("click", function() {
        $(".menu-button").removeClass("clicked");
        $(this).addClass("clicked");
    });

    $(document).ready(function() {
        $(".navbar-toggler").click(function() {
            $("#OpenNavbar").toggleClass("show");
        });
    });

    $('#link_truck').click(function() {
        location.reload();
        setTimeout(function() {
            location.reload();
        }, 100);
    });


    // Check for branch
    $(document).ready(function() {
        if (branchid != 0) {
            $('#link_rprt').hide();
        } else {
            $('#link_rprt').show();
        }
    });

    $(document).ready(function() {
        var navbar = $(".navbar");

        $(window).scroll(function() {
            if ($(this).scrollTop() > 0) {
                navbar.addClass("scrolled");
            } else {
                navbar.removeClass("scrolled");
            }
        });
    });

    // Logout
    $("#link_logout").click(function(e) {
        $("#NewModal").modal("show");
        $("#NewModal .modal-header").addClass("d-none");
        $("#NewModal .modal-body").html("<p align='center' style='padding: 20px;'><img src=\"assets/wedges.gif\" width=\"10%\"><br>Logging out your account...</p>");
        $("#NewModal .modal-footer").addClass("d-none");
        setTimeout(function() {
            location.href = "logout.php";
        }, 3000);
    });
</script>

</body>

</html>