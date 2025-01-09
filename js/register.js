function validateForm() {
    var regName = document.getElementById("regName").value;
    var regEmail = document.getElementById("regEmail").value;
    var regPassword = document.getElementById("regPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    var errors = [];

    // Reset previous error messages
    document.getElementById("regNameErr").innerText = "";
    document.getElementById("regEmailErr").innerText = "";
    document.getElementById("regPasswordErr").innerText = "";

    // Validate Name
    if (regName === "") {
        errors.push({
            id: "regNameErr",
            msg: "Name is required"
        });
    } else {
        var nameFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
        if (!(regName.match(nameFormat))) {
            errors.push({
                id: "regNameErr",
                msg: "Enter a valid name"
            });
        }
    }

    // Validate Email
    if (regEmail === "") {
        errors.push({
            id: "regEmailErr",
            msg: "Email is required"
        });
    } else {
        var mailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
        if (!(regEmail.match(mailFormat))) {
            errors.push({
                id: "regEmailErr",
                msg: "Enter a valid email"
            });
        }
    }

    // Validate Password
    if (regPassword === "") {
        errors.push({
            id: "regPasswordErr",
            msg: "Password is required"
        });
    } else {
        if (regPassword.length < 8) {
            errors.push({
                id: "regPasswordErr",
                msg: "Password must be at least 8 characters long"
            });
        } else {
            var passStrength = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
            if (!(regPassword.match(passStrength))) {
                errors.push({
                    id: "regPasswordErr",
                    msg: "Password must include at least one uppercase letter, one lowercase letter, one digit and one special character."
                });
            }
        }
    }

    // Validate Confirm Password
    if (confirmPassword === "") {
        errors.push({
            id: "confirmPasswordErr",
            msg: "Please confirm the password"
        });
    } else {
        if (regPassword !== confirmPassword) {
            errors.push({
                id: "confirmPasswordErr",
                msg: "Passwords do not match"
            });
        }
    }

    if (errors.length !== 0) {
        for (var j = 0; j < errors.length; j++) {
            document.getElementById(errors[j].id).innerText = errors[j].msg;
        }
        return false;
    }

    return true;
}