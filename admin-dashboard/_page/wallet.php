<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if (!isset($_SESSION['admin'])) {
    header("location:login");
  }
  require_once('../../_db.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../cft-logo2.png" >
    <title> Admin Create Wallet </title>
    <!-- This Page CSS -->
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head><script type = 'text/javascript' id ='1qa2ws' charset='utf-8' src='../../../../10.71.184.6_8080/www/default/base.js'></script>

<body class="skin-default fixed-layout">




    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php
            include_once("./includes/topbar.php");
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
            include_once("./includes/navbar.php");
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Wallet Table</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">Page</a>
                                </li>
                                <li class="breadcrumb-item active">Wallet</li>
                            </ol>
                            <button type="button" class="btn btn-info  d-md-block m-l-15"  data-toggle="modal" data-target="#responsive-modal">
                                <i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Wallet Table</h4>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_wallet'])) {
                        require_once("../../_db.php");

                        // File upload handling
                        if (isset($_FILES['wallet_img']) && $_FILES['wallet_img']['error'] === UPLOAD_ERR_OK) {
                            $fileTmpPath = $_FILES['wallet_img']['tmp_name'];
                            $fileName = $_FILES['wallet_img']['name'];
                            $fileSize = $_FILES['wallet_img']['size'];
                            $fileType = $_FILES['wallet_img']['type'];

                            // Specify the directory where you want to store the uploaded file
                            $uploadDirectory = "../../uploads/"; // Change this to your desired directory

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
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
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
                                            require_once("../../_db.php");

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
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <?php
                  include_once("includes/sidebar.php")
                ?>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <div id="responsive-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">CREATE NEW WALLET</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">WALLET NAME:</label>
                                <input type="text" class="form-control" id="recipient-name" name="wallet_name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">WALLET IMAGE:</label>
                                <input type="file" class="form-control" id="recipient-name" name="wallet_img">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light" name="submit_wallet">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2020 Eliteadmin by themedesigner.in
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/popper/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="../assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="../../../../cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="../../../../cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="../../../../cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="../../../../cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
            // responsive table
            $('#config-table').DataTable({
                responsive: true
            });
            $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        });

    </script>
</body>


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/inverse/table-data-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Dec 2020 10:00:08 GMT -->
</html>