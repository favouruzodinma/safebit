<?php
session_start();
require_once('_db.php');

function sendVerificationEmail($email) {
    // Implement your email sending logic using mail() function
    $to = $email;
    $subject = 'Account Verification';
    $message = 'Thank you for creating an account! Your account has been successfully verified.';
    $headers = 'From: safebit.org' . "\r\n" .
        'Reply-To: safebit99@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    if (isset($_POST['userid'])) {
        $userid = $_POST['userid'];
        $email = $_POST['email'];

        // Update user status to active
        $sql = "UPDATE user_login SET status = 'active' WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userid);
        $stmt->execute();

        // Send verification email
        sendVerificationEmail($email);

        // Redirect to dashboard or another page after verification
        header("Location: _page/dashboard?userid=$userid");
        exit;
    }
}

// Redirect to login page if the session is not set
header("Location: verify");
exit;
?>
