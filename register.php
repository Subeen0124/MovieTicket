<?php

if (isset($_POST['register'])) {
    include 'connect.php';

    echo "Form submitted!<br>";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    echo "Email: $email<br>";
    echo "Password: $password<br>";

    $query = "INSERT INTO users (name, email, password) VALUES ('$name','$email', '$password')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Registration successful! Redirecting...";
        header('Location: login.php');
        exit();
    } else {
        echo "Database error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="./css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="container bg-white p-6 rounded-lg shadow-md w-full max-w-md" id="signup">
        <h1 class="form-title text-2xl font-bold text-gray-800 text-center mb-6">Register</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            onsubmit="return validateForm()">
            <div class="input-group  mb-4 relative">
                <i class="fa fa-user absolute left-3 top-3 text-black"></i>
                <input type="text" id="regName" name="name" placeholder="Name"
                    class="w-full px-10 py-3 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                <label for="name">Name</label>
                <span class="error  text-red-500 text-sm" id="regNameErr"></span>
            </div>
            <div class="input-group  mb-4 relative">
                <i class="fa fa-envelope absolute left-3 top-3 text-black"></i>
                <input type="text" id="regEmail" name="email" placeholder="Email"
                    class="w-full px-10 py-3 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                <label for="email">Email</label>
                <span class="error text-red-500 text-sm" id="regEmailErr"></span>
            </div>
            <div class="input-group mb-4 relative">
                <i class="fa fa-lock absolute left-3 top-3 text-black"></i>
                <input type="password" id="regPassword" name="password" placeholder="Password"
                    class="w-full px-10 py-3 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                <label for="password">Password</label>
                <span class="error text-red-500 text-sm" id="regPasswordErr"></span>
            </div>
            <div class="input-group mb-4 relative">
                <i class="fa fa-lock absolute left-3 top-3 text-black"></i>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"
                    class="w-full px-10 py-3 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                <label for="confirmPassword">Confirm Password</label>
                <span class="error text-red-500 text-sm" id="confirmPasswordErr"></span>
            </div>
            <input type="submit" class="btn text-center border-none w-full py-3 bg-blue-500 text-white rounded-md
                    hover:bg-blue-600" value="Sign Up" name="register">
        </form>
        <div class="links mt-4 text-center">
            <p>Already Have An Account ? </p>
            <a href="login.php" id="signInButton" class="text-blue-500 text-sm hover:underline">Sign In</a>
        </div>
    </div>

    <script src="js/register.js"></script>
</body>

</html>