<div class="modal fade" id="sessionTimeoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(49, 49, 117); color:white;">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Notification</h1>

            </div>
            <div class="modal-body">
                <div class="image-wrapper text-center">
                    <img src="assets/timedout.png" alt="expired">
                </div>
                <div class="text-center mt-auto">
                    <h5><b>Your session has expired due to inactivity.</b></h5>
                    <h6>Please log in again.</h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-closee bouncy" onclick="redirectToLogout();" style="background-color: white; color: rgb(49, 49, 117); border: 2px solid rgb(49, 49, 117);">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-view:hover {
        background-color: rgb(49, 49, 117) !important;
        color: white !important;
    }

    .btn-closee:hover {
        background-color: rgb(49, 49, 117) !important;
        color: white !important;
    }

    .modal-footer .btn-closee {
        margin: 0;
        width: auto;
    }

    .bouncy {
        animation: bouncy 5s infinite linear;
        position: relative;
    }

    @keyframes bouncy {
        0% {
            top: 0em
        }

        40% {
            top: 0em
        }

        43% {
            top: -0.9em
        }

        46% {
            top: 0em
        }

        48% {
            top: -0.4em
        }

        50% {
            top: 0em
        }

        100% {
            top: 0em;
        }
    }
</style>