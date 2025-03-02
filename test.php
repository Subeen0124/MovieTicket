<?php

$password = 'Pa$$w0rd!';
$hash = password_hash($password, PASSWORD_DEFAULT);  // Hash the password

echo $hash;  // Check what the hash looks like

if (password_verify($password, '$2y$10$pP0vMfhI/kbdBh2pZkFF2ux5qNYMJoQy8BQl.hQPZJp8bn3/cJIjq')) {
    // Password matches, proceed to login
    echo 'Password is correct.';
} else {
    // Password does not match, return error
    echo json_encode(['error' => 'Invalid email or password.']);
}

?>