<?php
// Allow Cross-Origin Resource Sharing (CORS)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin (for development purposes)
header('Access-Control-Allow-Methods: POST, OPTIONS'); // Allow POST and OPTIONS methods
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allow specific headers

// Handle OPTIONS request for preflight check
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include the database connection
include 'connect.php';

// Start the session
session_start();

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get raw input data
    $input = json_decode(file_get_contents("php://input"), true);
    $name = trim($input['regName'] ?? '');
    $email = trim($input['regEmail'] ?? '');
    $password = trim($input['regPassword'] ?? '');

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Invalid email format.']);
        http_response_code(400); // Bad Request
        exit();
    }

    // Check if email already exists in the database
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['error' => 'Email is already registered.']);
        http_response_code(409); // Conflict
        exit();
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $con->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Return success response
        echo json_encode(['message' => 'Registration successful.']);
        http_response_code(201); // Created
    } else {
        // Database error
        echo json_encode(['error' => 'Database error. Please try again.']);
        http_response_code(500); // Internal Server Error
    }

    // Close the statement
    $stmt->close();
} else {
    // Invalid request method
    echo json_encode(['error' => 'Invalid request method.']);
    http_response_code(405); // Method Not Allowed
}

// Close the database connection
$con->close();
?>