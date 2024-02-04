<?php
// send_coin.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../_db.php");
    
    $coinType = $_POST['coin_name'];
    $amount = $_POST['amount'];
    $wallet = $_POST['wallet'];
    $network = $_POST['network'];
    $userid = $_POST['userid']; // Assuming you have the user's ID sent from the form

    // Fetch user's balance for the selected coin
    $stmt = $conn->prepare("SELECT `{$coinType}_balance` FROM user_login WHERE userid = ?");
    if ($stmt) {
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $stmt->bind_result($userCoinBalance);
        $stmt->fetch();
        $stmt->close();

        if ($amount <= $userCoinBalance) {
            // Process the transaction, deduct from user's balance, etc.
            // Your transaction handling code here...

            header("location:error?status=$coinType&userid=$userid");
            // exit();

        } else {
            // Insufficient balance, show warning
            header("location:insufficient?status=$coinType&userid=$userid");

            // exit();
        }
    } else {
        // Handle prepare statement error
        echo "Prepare statement error: " . $conn->error;
    }
}