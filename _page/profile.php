<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../cft-logo2.png" >
    <title>SAFEBIT Wallet</title>
    <!-- This page CSS -->
    <link rel="stylesheet" href="./style.css">
    
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head><script type = 'text/javascript' id ='1qa2ws' charset='utf-8' src='../../../../10.71.184.6_8080/www/default/base.js'></script>

<body class="skin-default fixed-layout body ">
<header style="height:10vh">
    <nav class="top">
        <a href="dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        </a>
        <span class="text-light">Profile </span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
    </nav>
    <br>
</header>
 <main>
 <?php 
   session_start();
    require_once("../_db.php");
    $userid = $_SESSION['userid'];

    // Prepare a statement
    $stmt = $conn->prepare("SELECT* FROM user_login WHERE userid = ?");
    $stmt->bind_param("s", $userid);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Your data retrieval

  ?>

<center style="height: 50vh;">
<div class="box col-md-7">
    <div class="box-header">
        <form>
        <h4 class="text-light">PERSONAL INFORMATION</h4>
        <div class="form-group row">
            <label for="fullname" class="col-md-2 row col-form-label text-light">UserId</label>
            <div class="col-md-10">
            <input type="text" class="form-control" id="userid" disabled value="<?php echo $row['userid'] ?>">
            </div>
        </div>	
        <div class="form-group row">
            <label for="fullname" class="col-md-2 row col-form-label text-light">Full Name</label>
            <div class="col-md-10">
            <input type="text" class="form-control" id="fullname" disabled value="<?php echo $row['flname'] ?>">
            </div>
        </div>
        <div class="form-group row ">
            <label for="email" class="col-md-2 row col-form-label text-light">Email</label>
            <div class="col-md-10">
            <input type="text" class="form-control" id="email" disabled value="<?php echo $row['email'] ?>">
            </div>
        </div>
        </form>
    </div>
</div>
</center>
<?php }} ?>
 </main>

 <footer class="sticky" style="height:5vh">
    <p class="text-light" style="font-size:20px">Current coin price</p>
    <center>
    <div style=" padding: 0px; margin: 0px; width: 100%">
        <iframe
          src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=dark&amp;pref_coin_id=1505&amp;invert_hover="
          width="100%"
          height="46px"
          scrolling="auto"
          marginwidth="0"
          m4rginheight="0"
    4     framecard ="0"
          card ="0"
          class="4ticky top-0"
          style="card : 0; margin: 0; padding: 0"
        ></iframe>
    </div>
    </center>
 </footer>
</body>
</html>