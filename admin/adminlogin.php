<?php
// Create connection
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 0) {
    // User is logged in, redirect to the welcome page
    header("Location: admindashboard.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbmovies");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define variables to store user input for login
$logUsername = $logPassword = "";

// Define variables to store error messages for login
$logPasswordErr = "";

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $logUsername = test_input($_POST["logUsername"]);

    $logPassword = test_input($_POST["logPassword"]);

    // Retrieve password from the database based on the entered Username
    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $logUsername);
    $stmt->execute();
    $stmt->bind_result($Password);
    $stmt->fetch();
    $stmt->close();

    // Verify the entered password against the  password
    if ($logPassword === $Password) {
        // Password is correct, redirect to the home page or perform other actions
        $_SESSION["username"] = $logUsername;
        $_SESSION["role"] = 0;
        header("Location: admindashboard.php");
        exit();
    } else {
        // Password is incorrect
        $logPasswordErr = "Invalid username or password";
    }
}

// Function to sanitize user input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="../images/favion.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/form.css">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="admin-header text-white bg-blue-600 p-4">
        <div class="logo-container max-w-4xl mx-auto flex justify-between items-center">
            <div class="logo text-3xl font-bold">
                MovieZone
            </div>
        </div>
    </header>
    <main class="flex-grow flex items-center justify-center">
        <div id="login-form" class="form-container bg-white p-8 shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Admin Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                onsubmit="return validateForm()">
                <!-- Login form fields go here -->
                <label for="logUsername" class=" block mb-4 text-black">Username:</label>
                <input type="text" name="logUsername" id="logUsername"
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="<?php echo $logUsername; ?>">
                <span class="error text-red-500text-sm" id="logUsernameErr"></span>
                <br><br>

                <label for="logPassword" class="mb-4 block text-black">Password:</label>
                <input type="password" name="logPassword" id="logPassword"
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="<?php echo $logPassword; ?>">
                <span class="error text-red-500 text-sm" id="logPasswordErr"><?php echo $logPasswordErr; ?></span>
                <br><br>

                <input
                    class="submit-button w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300"
                    type="submit" name="login" value="Login">
                <br>

            </form>
        </div>
    </main>
    <script>
        function validateForm() {
            var logUsername = document.getElementById("logUsername").value;
            var logPassword = document.getElementById("logPassword").value;

            // Reset previous error messages
            document.getElementById("logUsernameErr").innerText = "";
            document.getElementById("logUsernameErr").innerText = "";

            // Validate Username
            if (logUsername === "") {
                document.getElementById("logUsernameErr").innerText = "Username is required";
                return false;
            }

            // Validate Password
            if (logPassword === "") {
                document.getElementById("logPasswordErr").innerText = "Password is required";
                return false;
            }

            return true;
        }
    </script>
</body>

</html>