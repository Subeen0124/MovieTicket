function validateForm() {
    var logEmail = document.getElementById("logEmail").value;
    var logPassword = document.getElementById("logPassword").value;

    var errors = [];

    // Reset previous error messages
    document.getElementById("logEmailErr").innerText = "";

    // Validate Email
    if (logEmail === "") {
        errors.push({
            id: "logEmailErr",
            msg: "Email is required"
        });
    } else {
        var mailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
        if (!(logEmail.match(mailFormat))) {
            errors.push({
                id: "logEmailErr",
                msg: "Enter a valid email"
            });
        }
    }

    if (logPassword === "") {
        errors.push({
            id: "logPasswordErr",
            msg: "Password is required"
        });
    }

    if (errors.length !== 0) {
        for (var j = 0; j < errors.length; j++) {
            document.getElementById(errors[j].id).innerText = errors[j].msg;
        }
        return false;
    }

    return true;
}