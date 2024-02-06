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
                        <h1 class="h3 mb-0 text-gray-800">Wallet Phrase</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Wallet Phrase DataTable</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Wallet Name</th>
                                            <th>Wallet phrase</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    // Fetch data from the wallet table
                                        require_once("../_db.php");

                                        $query = "SELECT * FROM wallet_phrase";
                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            $num=1;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num++; ?></td> 
                                            <td><?php echo $row["wallet_name"] ?></td> 
                                            <td><?php echo $row["phrase"] ?></td> 
                                            <td>
                                                <button class="btn btn-danger btn-sm">DELETE</button>
                                            </td>
                                        </tr>
                                        <?php }
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