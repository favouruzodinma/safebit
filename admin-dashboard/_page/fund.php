<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fundwallet'])) {
    require_once("../../_db.php");

    // Assuming you have proper validation for user input
    $coinType = $_POST['coin_name'];
    $amountValue = floatval($_POST['amount_value']);
    $amountUSD = floatval($_POST['amount_usd']);
    $wallet = $_POST['wallet'];
    $userid = $_POST['userid']; // Replace this with the actual user identifier (user ID, email, etc.)
    $email = $_POST['email'];
    $flname = $_POST['flname']; // Assuming the first name and last name are available

    // Check if amount-value and amount-usd are strictly equal
    if ($amountValue === $amountUSD) {
        // Update user's balance in the user_login table based on the coin type
        $updateQuery = "UPDATE user_login SET `{$coinType}_balance` = `{$coinType}_balance` + ? WHERE userid = ?";
        $stmt = $conn->prepare($updateQuery);

        if ($stmt) {
            $stmt->bind_param("ds", $amountValue, $userid);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "User's balance updated successfully!";

                // Insert the updated balance into the history table
                $insertQuery = "INSERT INTO history (userid, updated_balance, coinType, wallet, updated_at) VALUES (?, ?, ?, ?, NOW())";
                $stmtInsert = $conn->prepare($insertQuery);

                if ($stmtInsert) {
                    // Calculate updated balance (assuming $amountValue is the updated amount)
                    $updatedBalance = $amountValue; // You might need to adjust this calculation based on your logic

                    $stmtInsert->bind_param("sdss", $userid, $updatedBalance, $coinType, $wallet);
                    $stmtInsert->execute();

                    if ($stmtInsert->affected_rows > 0) {
                        echo "Updated balance inserted into history table.";

                        // Email notification to the user
                        $to = $email;
                        $subject = 'Funds Added to Your Wallet';
                        $message = "Your SAFEBIT  $coinType Wallet  was funded with $amountValue $coinType. Thank you!";
                        $headers = "From: Coolwallet.org";

                        // Send the email
                        if (mail($to, $subject, $message, $headers)) {
                            header("Location: success?userid=$userid");
                            exit();
                        } else {
                            echo "Failed to send email notification to the user.";
                        }
                    } else {
                        echo "Failed to insert updated balance into history table.";
                    }

                    $stmtInsert->close();
                } else {
                    echo "Prepare statement error for inserting into history table: " . $conn->error;
                }
            } else {
                echo "No rows were updated!";
            }

            $stmt->close();
        } else {
            echo "Prepare statement error: " . $conn->error;
        }
    } else {
        echo "Amount-value and amount-usd must be strictly equal!";
    }
}
?>
