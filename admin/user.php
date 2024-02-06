<?php include_once("include/header.php")?>
<?php
if(isset($_GET['id'])){
    $id= $_GET['id'];
    if($_GET['status']=='delete'){
        //? delete user account
        $sql=$conn->query("DELETE FROM user_login WHERE userid='$id'");
       
  } }

  if(isset($_GET['id'])){
    $id= $_GET['id'];
    if($_GET['status']=='ban'){
        //? Ban user account
        $sql=$conn->query("UPDATE user_login SET status = 'ban' WHERE userid='$id'");
       
  } }
?>
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users Table</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users DataTable</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Userid</th>
                                            <th>KYC</th>
                                            <th>IP Address</th>
                                            <th>Status</th>
                                            <th>View</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            require_once('../_db.php'); // Include your database connection script

                                            // Check if the 'status' parameter is set in the URL
                                            if (isset($_GET['status'])) {
                                                $status = $_GET['status'];
                                                $sql = "SELECT * FROM user_login WHERE status = ? ORDER BY id DESC";

                                                // Prepare a parameterized statement
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("s", $status);
                                                $stmt->execute();

                                                $result = $stmt->get_result();
                                            } else {
                                                // If 'status' parameter is not set, fetch all records from 'user_login'
                                                $sql = "SELECT * FROM user_login ORDER BY id";
                                                $result = $conn->query($sql);
                                            }

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    $num=1; 
                                                    // Output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $num++; ?></td>
                                                <td><?php echo $row['flname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['userid']; ?></td>
                                                <td><img src="../../<?php echo $row['kyc']; ?>" alt="user_kyc"></td>
                                                <td><?php echo $row['ip_address']; ?></td>
                                                <td><?php 
                                                switch ($row['status']) {
                                                
                                                case 'active':
                                                    echo "<span class='badge badge-pill badge-success'>Verified</span>";
                                                    break;
                                                case 'ban':
                                                    echo "<span class='badge badge-pill badge-danger'>Banned</span>";
                                                    break;
                                                case 'pending':
                                                    echo "<span class='badge badge-pill badge-warning'>Pending</span>";
                                                    break; } ?></td>
                                                <td>
                                                    <a href="view?userid=<?php echo $row ['userid']?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill " viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg></a>
                                                </td>
                                                <td>
                                                <a href="user?status=ban&id=<?php echo $row['userid']; ?>" class="btn btn-warning btn-circle">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                <a href="user?status=delete&id=<?php echo $row['userid']; ?>" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            <?php    }
                                            }  }
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