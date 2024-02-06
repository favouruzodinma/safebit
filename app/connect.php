<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    header("location:../");
  }
  require_once('../_db.php');
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cool Wallet </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../cft-logo2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <!-- ======= Header ======= -->
  <header id="header" class=" pt-3 d-flex align-items-center">
  <nav class="top">
        <a href="../../_page/dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        </a>
  </nav>
  </header><!-- End Header -->
  <h2 class="bold d-flex justify-content-center text-light" style="font-weight:900; font-size:46px">
    Connect Wallet
  </h2>
  <p class="d-flex justify-content-center text-light">Open protocol for connecting Wallets to Dapps</p>
  <!-- End Header -->

  <main id="mains">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container-fluid">

         <div class="row gy-4 gap-4">
         <?php
          // Fetch data from the wallet table
          require_once("../_db.php");

          $query = "SELECT * FROM wallet";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              $num=1;
              while ($row = $result->fetch_assoc()) {
          ?>
          <a href="join?id=<?php echo $row ["id"] ?>" class="row text-dark col-lg-2 col-md-2 col-sm-1 col-6 service-item  py-2 ">
            <div class="icon text-center"><img src="<?php echo $row ["wallet_img"]; ?>" alt="" width=70 height=70 ></div>
            <div class="text-center">
              <small style="font-size:15px" class="text-light"><?php echo $row["wallet_name"]; ?></small>
            </div>
          </a>
          <!-- End Service Item -->
          <?php
              }
          }
          ?>
        </div>

      </div>
    </section><!-- End Featured Services Section -->

   
    
 
  </main><!-- End #main -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
 

</body>

</html>