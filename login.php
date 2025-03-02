<?php
// Include the database connection
include 'connect.php';

// Allow Cross-Origin Resource Sharing (CORS)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle OPTIONS request for preflight check
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Start the session
session_start();

// Check database connection
if (!$con) {
    echo json_encode(['error' => 'Database connection failed.']);
    http_response_code(500);
    exit;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input data
    $input = json_decode(file_get_contents("php://input"), true);
    $email = trim($input['logEmail'] ?? '');
    $password = trim($input['logPassword'] ?? '');

    // Validate email and password
    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Email and password are required.']);
        http_response_code(400);
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['userid'];
                $_SESSION['user_name'] = $user['name'];

                echo json_encode([
                    'data' => [
                        'user' => [
                            'id' => $user['userid'],
                            'name' => $user['name']
                        ]
                    ]
                ]);
                http_response_code(200);
            } else {
                error_log("Password mismatch: Provided password is incorrect.");
                echo json_encode(['error' => 'Invalid email or password.']);
                http_response_code(401); // Unauthorized
            }

        } else {
            echo json_encode(['error' => 'No user found.']);
            http_response_code(401); // Unauthorized
        }
    } else {
        // Log error for debugging (optional for development)
        error_log("Database query failed: " . $stmt->error);

        echo json_encode(['error' => 'Database query failed.']);
        http_response_code(500); // Internal Server Error
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request method.']);
    http_response_code(405); // Method Not Allowed
}

// Close the database connection
$con->close();
?>