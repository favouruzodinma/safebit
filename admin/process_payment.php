<?php
// Include your database connection file (e.g., _db.php)
require_once("../_db.php");

// Function to send email notification
function sendEmailNotification($email, $subject, $coinType, $amount) {
    // Set the recipient's email
    $to = $email;

    // Message content with HTML formatting
    $message = "<html>
    <head>
        <style>
            .container {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
        <center>
            <img src='https://www.safebit.pro/SBT_logo.png' alt='logo' width='100' height='100'/>
        </center>
            <h3>Your Payment Approved</h3>
            <p>Your payment of $amount $coinType has been approved. Thank you for working with SAFEBIT WALLET!</p>
        </div>
    </body>
    </html>";

    // Set additional headers if needed
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    // Additional headers for sender information
    $headers .= 'From: Safebit Wallet Payment <noreply@safebit.pro>' . "\r\n";
    $headers .= 'Reply-To: safebit99@gmail.com' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    // Send the email
    return mail($to, $subject, $message, $headers);
}

// Assuming you pass the payment ID as a query parameter
$paymentId = $_GET['payment_id'];

// Fetch payment details from the database based on payment ID
$stmt = $conn->prepare("SELECT * FROM user_history WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("s", $paymentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $payment = $result->fetch_assoc();
    $stmt->close();

    if ($payment) {
        if ($payment['status'] == 'pending') {
            // Update payment status to approved
            $updateStmt = $conn->prepare("UPDATE user_history SET status = 'approved' WHERE id = ?");
            if ($updateStmt) {
                $updateStmt->bind_param("s", $paymentId);
                $updateStmt->execute();

                // Subtract the approved amount from the user's coin balance
                $coinType = $payment['coinType'];
                $amount = $payment['amount'];
                $userId = $payment['userid'];
                $email = $payment['email'];

                $updateBalanceStmt = $conn->prepare("UPDATE user_login SET `{$coinType}_balance` = `{$coinType}_balance` - ? WHERE userid = ?");
                if ($updateBalanceStmt) {
                    $updateBalanceStmt->bind_param("ds", $amount, $userId);
                    $updateBalanceStmt->execute();
                    $updateBalanceStmt->close();

                    // Additional logic after approval if needed

                    // Send email notification
                    $subject = 'Payment Approved';
                    if (sendEmailNotification($email, $subject, $coinType, $amount)) {
                        echo "Payment approved successfully, and email sent!";
                    } else {
                        echo "Payment approved successfully, but failed to send email.";
                    }

                } else {
                    echo "Error updating user's balance: " . $conn->error;
                }

                $updateStmt->close();
            } else {
                echo "Error updating payment status: " . $conn->error;
            }
        } elseif ($payment['status'] == 'approved') {
            echo "Payment already approved.";
        } elseif ($payment['status'] == 'declined') {
            echo "Payment already declined.";
        }
    } else {
        echo "Payment not found.";
    }
} else {
    echo "Error fetching payment details: " . $conn->error;
}

// Close your database connection
$conn->close();
?>
