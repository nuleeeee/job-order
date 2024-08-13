
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCORE-ADMIN | Login</title>

    <!-- Bootstrap 5.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap-icons-1.10.5/font/bootstrap-icons.css">

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.7.0.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheets/login.css">
    <link rel="icon" type="image/x-icon" href="assets/hricon.ico">

    <!-- Alertify JS -->
    <link rel=" stylesheet" href="css/alertify.min.css" />
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css" />

    </style>
</head>

<body class="text-center">

    <!-- The Main Body -->
    <div style="float: left;">
        <image class="crimsbg" src="assets/crimslogin.png" alt=""></image>
    </div>
    <main class="form-signin w-100 m-auto">

        <div class="login-container container-sm">
            <div class="fields">
                <div class="loginC">
                    
                    <image class="imglogin" src="assets/image2.png" alt=""></image>
                    <br>
                    <div style="margin-bottom: 15%"></div>
                    <div class="form-floating">
                        <input type="password" id="pin" name="pin" placeholder="6 Digit Pin" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" class="form-control">
                        <label for="floatingPassword">Enter (6) digit employee pin</label>
                    </div>

                    <br>

                    <div class="buttons">
                        <button class="w-100 btn btn-lg btn-primary btnLogin" name="login" id="Login" onclick="login();">
                            <span class="loginBtn">Login</span>
                        </button>
                    </div>
                    <div style="margin-bottom: 15%"></div>
                </div>
            </div>
        </div>
    </main>

    <div id="receiver" hidden></div>

    <!-- Alertify JS -->
    <script src="js/alertify.min.js"></script>

    <script>
        $("#pin").keyup(function(e) {
            if (e.keyCode == 13) {
                login();
            }
        });

        function login() {
            var login_pin = $("#pin").val();
            $.post("phpconfig/login.inc.php", {
                login_pin: login_pin
            }, function(result) {
                if (result == 1) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Incorrect Pin Code').dismissOthers();

                } else {
                    localStorage.setItem("login_name", result);
                    localStorage.setItem("alertShown", result);
                    window.location.href = "home.php";
                }
            });
        }

        /* Clear Login Input Fields */
        const LogtinBtn = document.getElementById('Login');
        LogtinBtn.addEventListener('click', function() {
            event.preventDefault();
            const pinInput = document.getElementById('pin');

            pinInput.value = '';
        });

        $("#pin").keyup(function(e) {
            if ((27 === event.which) || (13 === event.which)) {
                event.preventDefault();
                //this should delete value from the input
                event.currentTarget.value = "";
            }
        })
        /* End for Clear Login Input Fields */

    </script>


</body>

</html>