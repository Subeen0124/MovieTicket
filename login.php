<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="./css/output.css" rel="stylesheet">
</head>

<body classs=" bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="container bg-white p-6 rounded-lg shadow-md w-full max-w-md" id="signin">
        <h1 class="form-title text-3xl font-semibold text-center text-gray-800 mb-6">Sign In</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            onsubmit="return validateForm()">
            <div class="input-group mb-4 relative">
                <i class="fa fa-envelope absolute left-3 top-3 text-black"></i>
                <input type="text" id="logEmail" name="logEmail" placeholder="Email"
                    class="w-full px-10 py-3 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                <label for="logEmail">Email</label>
                <span class="error text-red-500 text-sm" id="logEmailErr"></span>
            </div>
            <div class="input-group mb-4 relative">
                <i class="fa fa-lock absolute left-3 top-3 text-black"></i>
                <input type="password" id="logPassword" name="logPassword" placeholder="Password"
                    class="w-full px-10 py-3 border border-black rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                <label for="logPassword">Password</label>
                <span class="error text-red-500 text-sm" id="logPasswordErr"></span>
            </div>
            <p class="forgot text-right mb-4">
                <a href="#" class="text-blue-500 text-sm hover:underline">Frogot Password</a>
            </p>
            <input type=" submit " class="btn text-center border-none w-full py-3 bg-blue-500 text-white rounded-md
                    hover:bg-blue-600" value=" Sign In" name="signin ">
        </form>
        <div class="links mt-4 text-center">
            <p>Don't Have An Account Yet ? </p>
            <a href="register.php" id="signUpButton" class="text-blue-500 text-sm hover:underline">Sign Up</a>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>

</html>

<?php
session_start(); // Start the session

// Include the database connection
include 'connect.php';

if (isset($_POST['signin'])) {
    // Retrieve form data
    $email = $_POST['logEmail'];
    $password = $_POST['logPassword'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // "s" indicates the email is a string

    // Execute the statement and get the result
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Check if the password is correct
        if ($password == $user['password']) {
            // Password is correct, set session and redirect
            $_SESSION['email'] = $email;
            header('location: index.php'); // Redirect to the home page
        } else {
            echo "<script>alert('Invalid Email or Password')</script>";
        }
    } else {
        echo "<script>alert('Invalid Email or Password')</script>";
    }
}
?>