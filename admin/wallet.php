<?php include_once("include/header.php")?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include_once('include/navbar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              <?php include_once('include/topbar.php') ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Wallet</h1>
                        <a href="#" data-toggle="modal" data-target="#walletModal" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Create Wallet</a>
                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_wallet'])) {
                        require_once("../_db.php");

                        // File upload handling
                        if (isset($_FILES['wallet_img']) && $_FILES['wallet_img']['error'] === UPLOAD_ERR_OK) {
                            $fileTmpPath = $_FILES['wallet_img']['tmp_name'];
                            $fileName = $_FILES['wallet_img']['name'];
                            $fileSize = $_FILES['wallet_img']['size'];
                            $fileType = $_FILES['wallet_img']['type'];

                            // Specify the directory where you want to store the uploaded file
                            $uploadDirectory = "../uploads/"; // Change this to your desired directory

                            // Move the uploaded file to the specified directory
                            $targetFilePath = $uploadDirectory . basename($fileName);

                            // Check if the file already exists in the database
                            $checkQuery = "SELECT COUNT(*) AS count FROM wallet WHERE wallet_img = ?";
                            $checkStmt = $conn->prepare($checkQuery);

                            if ($checkStmt) {
                                $checkStmt->bind_param("s", $targetFilePath);
                                $checkStmt->execute();
                                $checkResult = $checkStmt->get_result();
                                $row = $checkResult->fetch_assoc();

                                if ($row['count'] > 0) {
                                    $err = "
                                    <div class='alert alert-danger' role='alert'>
                                        <strong>Image already exists in the database!</strong> 
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                                } else {
                                    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                                        // Insert a new record into the wallet table with the file path
                                        $insertQuery = "INSERT INTO wallet (wallet_name, wallet_img) VALUES (?, ?)";
                                        $stmt = $conn->prepare($insertQuery);

                                        if ($stmt) {
                                            $walletName = $_POST['wallet_name']; // Assuming you have a field for the wallet name in your form
                                            $stmt->bind_param("ss", $walletName, $targetFilePath);
                                            $stmt->execute();

                                            if ($stmt->affected_rows > 0) {
                                                $success = "
                                                <div class='alert alert-success' role='alert'>
                                                    <strong>Wallet details inserted successfully!</strong> 
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>";
                                            } else {
                                                $err = "
                                                <div class='alert alert-danger' role='alert'>
                                                    <strong>Failed to insert wallet details!</strong> 
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>";
                                            }

                                            $stmt->close();
                                        } else {
                                            echo "Prepare statement error: " . $conn->error;
                                        }
                                    } else {
                                        $err1 = "
                                        <div class='alert alert-danger' role='alert'>
                                            <strong>File upload failed!</strong> 
                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>";
                                    }
                                }
                            } else {
                                echo "Prepare statement error: " . $conn->error;
                            }
                        } else {
                            $err2 = "
                            <div class='alert alert-danger' role='alert'>
                                <strong>No file uploaded or an error occurred during upload.</strong> 
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                        }
                    }
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Wallet DataTable</h6>
                            <?php if (isset($err)) : ?>
                                <?php echo $err; ?>
                            <?php endif; ?>
                            <?php if (isset($err1)) : ?>
                                <?php echo $err1; ?>
                            <?php endif; ?>
                            <?php if (isset($err2)) : ?>
                                <?php echo $err2; ?>
                            <?php endif; ?>
                            <?php if (isset($success)) : ?>
                                <?php echo $success; ?>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Wallet Name</th>
                                            <th>Wallet Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        // Fetch data from the wallet table
                                        require_once("../_db.php");

                                        $query = "SELECT * FROM wallet";
                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            $num=1;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $num++; ?></td> 
                                                    <td><?php echo $row['wallet_name']; ?></td> 
                                                    <td><img src="<?php echo $row['wallet_img']; ?>" alt="Wallet image" width=70 height=70 class="img-circle"></td> 
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">DELETE</button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once("include/footer.php") ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

   <?php include_once("include/scripts.php") ?>

</body>

</html>