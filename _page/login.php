<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if (isset($_SESSION['user'])) {
	header("location:_page/dashboard");
  }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>SAFEBIT Wallet</title>
    
    <!-- page css -->
    <link href="dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    
</head><script type = 'text/javascript' id ='1qa2ws' charset='utf-8' src='../../../../10.71.184.6_8080/www/default/base.js'></script>

<body class="skin-default card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                <?php
                    require_once('_db.php'); // Your database connection script

                    if (isset($_POST['user_login'])) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        
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
                                $userid = $_SESSION['userid'];
                                header("Location:_page/dashboard?userid=$userid");
                                exit;
                            } else {
                                $error = "
                                <div class='alert alert-danger d-flex justify-space-between' role='alert'>
                                    <strong>Password does not match this email address!</strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                            }
                        } else {
                            $error = "
                            <div class='alert alert-danger d-flex justify-space-between' role='alert'>
                                <strong>Invalid Email or Password submitted!</strong> 
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                        }
                    }
                ?>
                  <?php
                    if(isset($_POST['create_wallet'])){
                        $userid = ("SBT" .rand(203994 , 485789));

                        $flname =$_POST["flname"];
                        $email =$_POST["email"];
                        $password =$_POST["password"];
                        $cpassword =$_POST["cpassword"];
                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                        
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        $errors = array();

                        if (empty($flname)OR empty($email) OR empty($password) OR empty($password)){
                            array_push($errors,"All field ar e required");
                        }
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            array_push($errors,"Email is not Valid");
                        }
                        if(strlen($password)<8){
                            array_push($errors,"Character must be at least 8 characters long ");
                        }
                        if($password!==$cpassword){
                            array_push($errors,"Password and comfirm password dont match");
                        }
                        require_once('_db.php');
                        $sql = "SELECT * FROM user_login WHERE email='$email' ";
                        $result= mysqli_query($conn,$sql);
                        $rowCount = mysqli_num_rows($result);
                        if($rowCount>0){
                            array_push($errors,"Email has already been used..");
                        }
                        if(count($errors)>0){
                            foreach($errors as $error){
                                $error = "
                                    <div class='alert alert-danger d-flex justify-space-between'>
                                    <strong>$error</strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                // echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }else{
                            require_once('_db.php');
                            $sql = "INSERT INTO  user_login (userid ,flname, email, password, ip_address) VALUES (?,?,?,?,?)";
                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                            if($prepareStmt){
                                mysqli_stmt_bind_param($stmt,"sssss",$userid,$flname,$email,$passwordHash, $ipaddress);
                                mysqli_stmt_execute($stmt);
                                $error = "
                                <div class='alert alert-success d-flex justify-space-between'>
                                <strong>Registered Successfully...  </strong> 
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }else{
                                die("something went wrong");
                            }
                        }

                    }
                    ?>
                    <form class="form-horizontal form-material" id="loginform" action="#" method="POST">
                        <h3 class="text-center m-b-20">Sign In</h3>
                        <?php if (isset($error)) : ?>
                            <div><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" required="" placeholder="Email" name="email"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                    </div> 
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i>Create Account</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" name="user_login">Log In</button>
                            </div>
                            <br>
                            <p class="text-muted bg-warning">To avoid your SAFEBIT wallet from been hacked , write down in some were save that you can't forget! </p>
                            
                        </div>
                    </form>
                  
                    <form class="form-horizontal" id="recoverform" action="#" method="POST">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3> Creat A SAFEBIT Wallet Account</h3>
                                <p class="text-muted">Few more steps and you wallet is ready to use <br> Dive in and start your crypto journy start secure! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Username" name="flname"> </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" required="" placeholder="Email" name="email"> </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password"> </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Comfirm Password" name="cpassword"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                    </div> 
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" id="to-login" class="text-muted"><i class="fas fa-lock m-r-5"></i>SIGN IN</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="create_wallet">Start Using SAFEBIT Wallet</button>
                            </div>
                            <br>
                            <p class="text-muted bg-warning">To avoid your SAFEBIT wallet from been hacked , write down in some were save that you can't forget! </p>
                            
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="./assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./assets/node_modules/popper/popper.min.js"></script>
    <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').on("click", function() {
            $("#recoverform").slideUp();
            $("#loginform").fadeIn();
        });
    </script>
    
</body>


</html>