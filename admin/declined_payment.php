<?php 
// Include your database connection file (e.g., _db.php)
require_once("../_db.php");

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
            // Update payment status to declined
            $updateStmt = $conn->prepare("UPDATE user_history SET status = 'declined' WHERE id = ?");
            if ($updateStmt) {
                $updateStmt->bind_param("s", $paymentId);
                $updateStmt->execute();

                // Additional logic after declining if needed

                echo "Payment declined successfully!";
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
