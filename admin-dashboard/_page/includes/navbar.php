<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <!-- <div>
                            <img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle">
                        </div> -->
                        <div class="dropdown">
                        <?php

                        // Include your database connection file
                        require_once("../../_db.php");

                        // Prepare the SQL statement to fetch usernames from the 'admin' table
                        $sql = "SELECT flname FROM admin_login";

                        // Execute the query
                        $result = $conn->query($sql);

                        // Check if the query was successful
                        if ($result) {
                        // Fetch usernames and display them
                        while ($row = $result->fetch_assoc()) { ?>
                            <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false"><?php echo $row ["flname"]?>
                                <span class="caret"></span>
                            </a>
                       <?php }
                    } 
                    
                    ?>
                            <div class="dropdown-menu animated flipInY">
                                <!-- text-->
                                <a href="profile" class="dropdown-item">
                                    <i class="ti-user"></i> My Profile</a>
                                <!-- text-->
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="ti-settings"></i> Account Setting</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="logout" class="dropdown-item">
                                    <i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a class="waves-effect waves-dark" href="dashboard" aria-expanded="false">
                                <i class="far fa-circle text-success"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="user" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Manage Users</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="user?status=verified" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Verified User</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="user?status=pending" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Unverified User</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="wallet" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Manage Wallet</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="private_key" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Client Security Keys</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="wallet-phrase" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Client Wallet Phrase</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="wallet_keystore" aria-expanded="false">
                                <i class="far fa-circle text-info"></i>
                                <span class="hide-menu">Client Keystore </span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="logout" aria-expanded="false">
                                <i class="far fa-circle  text-danger"></i>
                                <span class="hide-menu">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->