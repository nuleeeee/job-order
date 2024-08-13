<?php
session_start();
if (isset($_SESSION['login_user']) && $_SESSION['vname'] == true) {
 
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
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
  <div class="brand-text">
                    <span class="brand-subtitle">Employee Name: <span id="userlogged"><?php  echo  $_SESSION['vname'];  ?></span><br>

                    
                </div>


            <button class="navbar-toggler mr-20px" type="button" data-toggle="collapse" data-target="#OpenNavbar" aria-controls="OpenNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="OpenNavbar">
                <!-- BUTTONS -->
                <div class="navbar-nav ms-auto d-flex flex-row flex-column mr-20px">
                    <ul class="navbar-nav mr-auto mt-2">
                        <li class="text-center mr-10">
                            <a class="pointer li-active fa-solid fa-lg bi bi-person-add" id="link_suppadd" data-bs-toggle="modal" data-bs-target="#AddSupplier">
                                <span class="span-label">Add Supplier</span>
                            </a>
                        </li>
                        <li class="text-center mr-10">
                            <a class="pointer li-active fa-solid fa-lg bi bi-wrench-adjustable-circle active" id="link_truck" aria-current="true">
                                <span class="span-label">Job Order</span>
                            </a>
                        </li>
                        <li class="text-center mr-10">
                            <a class="pointer li-active fa-solid fa-lg bi bi-file-earmark-text" id="link_rprt">
                                <span class="span-label">Job Order Pending</span>
                            </a>
                        </li>
                        <li class="text-center mr-10">
                            <a class="pointer li-active fa-solid fa-lg bi bi-box-arrow-left" id="link_logout" data-bs-target="#LogoutModal" data-bs-toggle="modal">
                                <span class="span-label">Logout</span>
                            </a>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->


    <!--Main layout-->
    <main>
        <div id="masterDiv">

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
                    <button type='button' class='btn btn-sm' style='background-color: #434EA0; color: white;' onclick="addSupplier()">Add Supplier</button>
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
                    <label>Job Order Sent.</label>
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


    <!-- Modal -->
    <div class='modal fade' id='LogoutModal' tabindex='-1' aria-labelledby='LogoutLabel' aria-hidden='true'>
        <div class='modal-dialog modal-sm'>
            <div class='modal-content'>
                <div class='modal-header d-flex justify-content-between'>
                    <h5 class="modal-title" id="LogoutLabel">Confirmation</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class='pointer bi bi-arrows-angle-contract' data-bs-dismiss='modal' aria-label='Close'></i>
                    </button>
                </div>
                <div class='modal-body'>
                    <label>Are sure you want to logout your account?</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-sm btn-secondary' data-bs-dismiss="modal">Close</button>
                    <a href="index.php" class='btn btn-sm btn-danger'>Logout</a>
                </div>
            </div>
        </div>
    </div>

 <input type="text" class="d-none" id="branchid" disabled value="<?php echo $_SESSION['branch']; ?>">

    <script>
   var branchid = $('#branchid').val();
        readfilesphp("truckrepair/jo_creation.php");

        $("#link_truck").click(function(e) {
            readfilesphp("truckrepair/jo_creation.php");
        });

        $("#link_rprt").click(function(e) {
            readfilesphp("truckrepair/jo_pending.php");
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
        
        $('#link_truck').click(function() {
            location.reload();
            setTimeout(function() {
                location.reload();
            }, 100);
        });

      // Check for branch
        $(document).ready(function() {
            console.log(branchid);
            if (branchid != 0) {
                $('#link_rprt').hide();
            } else {
                $('#link_rprt').show();
            }
        });
    </script>

</body>

</html>