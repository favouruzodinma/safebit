<?php


session_start();

function generateUserId() {
    return "CWT" . rand(203994, 485789);
}

function displayError($message) {
    return "
        <div class='alert alert-danger d-flex justify-content-between'>
            <strong>$message</strong> 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
}

if (isset($_POST['create_wallet'])) {
    $userid = generateUserId();
    $flname = $_POST["flname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $ipaddress = $_SERVER['REMOTE_ADDR'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = [];

    if (empty($flname) || empty($email) || empty($password) || empty($password)) {
        $errors[] = "All fields are required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if ($password !== $cpassword) {
        $errors[] = "Password and confirm password don't match";
    }

    require_once('_db.php');
    $sql = "SELECT * FROM user_login WHERE email='$email' ";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        $errors[] = "Email has already been used";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../login.php");
        exit;
    }

    $sql = "INSERT INTO user_login (userid, flname, email, password, ip_address) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $userid, $flname, $email, $passwordHash, $ipaddress);
        mysqli_stmt_execute($stmt);

        $successMessage = displayError("Registered Successfully");
        $_SESSION['success_message'] = $successMessage;
        header("Location: ../login.php");
        exit;
    } else {
        die("Something went wrong");
    }
}

if (isset($_POST['user_login'])) {
	$email = $_POST['email'];
    $password = $_POST['password'];
	require_once('_db.php');
    $sql = "SELECT * FROM user_login WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['userid'] = $user['userid'];
			$_SESSION['user'] = 'yes';
            header("Location: ../dashboard");
            exit;
        } else {
            $error = "
            <div class='' role='alert'>
                <strong>Password does not match this email address!</strong> 
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
    } else {
        $error = "
        <div class='' role='alert'>
            <strong>Invalid Email or Password submitted!</strong> 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    if (isset($error)) {
        $_SESSION['login_error'] = $error;
        header("Location: ../login.php");
        exit;
    }
}
?>
