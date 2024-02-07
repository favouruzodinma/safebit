<?php
// Function to send email notification
// Function to send email notification
function sendEmailNotification($email, $flname, $coinType, $amountValue) {
    $to = $email;
    $subject = 'Account Wallet Funding';
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
            <h3>Hello $flname..</h3>
            <p><i>Your safebit $coinType wallet was funded with $amountValue $coinType.</i></p>
            <p>Thank you!</p>
        </div>
    </body>
</html>";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= 'From: safebit.pro' . "\r\n" .
        'Reply-To: safebit99@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);
}


// Main logic for updating user balance and inserting into history
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fundwallet'])) {
    require_once("../_db.php");

    $coinType = $_POST['coin_name'];
    $amountValue = floatval($_POST['amount_value']);
    $amountUSD = floatval($_POST['amount_usd']);
    $wallet = $_POST['wallet'];
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    $flname = $_POST['flname'];

    if ($amountValue === $amountUSD) {
        $updateQuery = "UPDATE user_login SET `{$coinType}_balance` = `{$coinType}_balance` + ? WHERE userid = ?";
        $stmt = $conn->prepare($updateQuery);

        if ($stmt && $stmt->bind_param("ds", $amountValue, $userid) && $stmt->execute() && $stmt->affected_rows > 0) {
            echo "User's balance updated successfully!";

            // Insert the updated balance into the history table
            $insertQuery = "INSERT INTO history (userid, updated_balance, coinType, wallet, updated_at) VALUES (?, ?, ?, ?, NOW())";
            $stmtInsert = $conn->prepare($insertQuery);

            if ($stmtInsert && $stmtInsert->bind_param("sdss", $userid, $amountValue, $coinType, $wallet) && $stmtInsert->execute() && $stmtInsert->affected_rows > 0) {
                echo "Updated balance inserted into history table.";

                // Send email notification
                if (sendEmailNotification($email, $flname, $coinType, $amountValue)) {
                    header("location:success?userid=$userid");
                } else {
                    echo "Failed to send email notification to the user.";
                }

                $stmtInsert->close();
            } else {
                echo "Failed to insert updated balance into history table.";
            }

            $stmt->close();
        } else {
            echo "Error updating user's balance!";
        }
    } else {
        echo "Amount-value and amount-usd must be strictly equal!";
    }
}
?>


