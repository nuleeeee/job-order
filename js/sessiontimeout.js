document.addEventListener("DOMContentLoaded", function () {
    const worker = new Worker('js/worker.js');

    worker.onmessage = function(event) {
        const countdown = event.data;
        $(".timer").text(countdown);

        if (countdown <= 0) {
            worker.terminate();
            // Session expired, perform logout
            redirectToLogout();
        }
    };

    // Reset the countdown when the mouse moves or a key is pressed
    document.addEventListener('mousemove', resetCountdown);
    document.addEventListener('mousedown', resetCountdown);
    document.addEventListener('keydown', resetCountdown);

    function resetCountdown() {
        worker.postMessage('reset');
    }

    function redirectToLogout() {
        $("#NewModal").modal("show");
        $("#NewModal .modal-header").addClass("d-none");
        $("#NewModal .modal-body").html("<p align='center' style='padding: 20px;'><img src=\"assets/wedges.gif\" width=\"10%\"><br>Logging out your account...</p>");
        $("#NewModal .modal-footer").addClass("d-none");
        setTimeout(function () {
            window.location = "logout.php";
        }, 2000);
    }
});