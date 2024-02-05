<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFEBIT Wallet</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        form button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        span {
            color: orange;
        }
    </style>
</head>
<body>
    <span>Click on the button to verify your account!!</span>
    <br>
    <?php
    require_once("_db.php");
    $userid = $_GET['userid'];

     // Prepare a statement
     $stmt = $conn->prepare("SELECT* FROM user_login WHERE userid = ?");
     $stmt->bind_param("s", $userid);
     $stmt->execute();
 
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             // Your data retrieval
   ?>
    <form action="process" method="POST">
        <input type="hidden" name="userid" value="<?php echo isset($_GET['userid']) ? $_GET['userid'] : ''; ?>">
        <input type="hidden" value="<?php echo $row['email'];?>" name="email">
        <button name="verify">Verify</button>
    </form>
    <?php }} ?>
    <footer>
        <!-- ... (your existing footer content) ... -->
    </footer>
    <script>
        function verifyFunction() {
            alert("Verification in progress!");
            // Add your verification logic here
        }
    </script>
</body>
</html>
