let countdown = 7 * 60; // 5 minutes in seconds
function updateTimer() {
    if (countdown > 0) {
        countdown--;
    }
    postMessage(countdown);
}

const timerInterval = setInterval(updateTimer, 1000);

// Listen for messages from the main script
onmessage = function(event) {
    if (event.data === 'reset') {
        countdown = 7 * 60;
    }
};

// Clean up the interval when the worker is terminated
onclose = function() {
    clearInterval(timerInterval);
    postMessage('expired');
};