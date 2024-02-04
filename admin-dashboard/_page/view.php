<!DOCTYPE html>
<html lang="en">
<?php
$url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,ripple,trx,tether,usd-coin,binancecoin&vs_currencies=usd";
$get = file_get_contents($url);
$prices = json_decode($get, true);

$defaultPrices = [
    'bitcoin' => 36000,    // Replace with a default price for Bitcoin
    'ethereum' => 2000,    // Replace with a default price for Ethereum
    'ripple' => 1.5,       // Replace with a default price for Ripple
    'trx' => 0.1,          // Replace with a default price for TRON
    'tether' => 1,         // Replace with a default price for Tether
    'usd-coin' => 1,       // Replace with a default price for USD Coin
    'binancecoin' => 300,  // Replace with a default price for Binance Coin (BNB)
    'usd-tether' => 1,     // Replace with a default price for USDT-BNB
    'usd-coin' => 1        // Replace with a default price for USDC
];

// Assign prices or use default values if API fails
$bitcoinPrice = $prices['bitcoin']['usd'] ?? $defaultPrices['bitcoin'];
$ethereumPrice = $prices['ethereum']['usd'] ?? $defaultPrices['ethereum'];
$ripplePrice = $prices['ripple']['usd'] ?? $defaultPrices['ripple'];
$trxPrice = $prices['trx']['usd'] ?? $defaultPrices['trx'];
$tetherPrice = $prices['tether']['usd'] ?? $defaultPrices['tether'];
$usdCoinPrice = $prices['usd-coin']['usd'] ?? $defaultPrices['usd-coin'];
$bnbPrice = $prices['binancecoin']['usd'] ?? $defaultPrices['binancecoin'];
$usdtbnbPrice = $prices['usd-tether']['usd'] ?? $defaultPrices['usd-tether'];
$usdcPrice = $prices['usd-coin']['usd'] ?? $defaultPrices['usd-coin'];
?>

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
    <title> Admin dashboard </title>
    <!-- This Page CSS -->
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
                        <h4 class="text-themecolor">View User</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)" class="text-dark">Page</a>
                                </li>
                                <li class="breadcrumb-item active">Veiw</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- <div class="row">
                    <div class="col-12"> -->
                        <!-- <div class="card " > -->
                            <div class="card-body" style="background-color: #111315 !important">
                            <?php 
                            if (isset($_GET['userid'])) {
                                require_once("../../_db.php");
                                $userid = $_GET['userid'];
                            
                                // Prepare a statement to fetch user details by userid
                                $stmt = $conn->prepare("SELECT * FROM user_login WHERE userid = ?");
                                $stmt->bind_param("s", $userid);
                                $stmt->execute();
                            
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Your data retrieval
                                
                                ?>
                                <h4 class="card-title text-light">Veiw User</h4>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-body text-light">
                                            <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle" width="150" />
                                                <h4 class="card-title m-t-10"><?php  echo $row ['flname']?></h4>
                                                <small class="col-md-10"> <?php if($row['status']=='verified'){?>
                                                <a href= "manage_user.php?id=<?php echo
                                                $row['userid']; ?>&status=disabled " class="btn btn-primary btn-sm my-2">Disable User</a>
                                                <?php }else{ ?>
                                                <a href="manage_user.php?id=<?php echo
                                                $row['userid']; ?>&status=enable " class="btn btn-warning btn-sm ">Enable user</a>
                                                <?php } ?></small>
                                            </center>
                                        </div>
                                        <div>
                                            <hr> </div>
                                        <div class="card-body text-light"> <small class="text-muted">Email address </small>
                                            <h6><?php  echo $row ['email']?></h6> <small class="text-muted p-t-30 db">User ID</small>
                                            <h6><?php  echo $row ['userid']?></h6> <small class="text-muted p-t-30 db">IP Address</small>
                                            <h6><?php  echo $row ['ip_address']?></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                            <div class="card-body text-light">
                                                <h4 class="card-title">SEND TO USER WALLET</h4>
                                                <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
                                                <form class="form p-t-20" method="POST" action="fund">
                                                    <input type="hidden" value="<?php  echo $userid?>" name="userid">
                                                    <input type="hidden" value="<?php  echo $row ['email']?>" name="email">
                                                    <input type="hidden" value="<?php  echo $row ['flname']?>" name="flname">
                                                    <div class="form-group">
                                                        <label for="exampleInputuname">NETWORK</label>
                                                        <select name="coin_name" id="" class="form-control" required>
                                                            <option value="bitcoin">BITCOIN</option>
                                                            <option value="binancecoin">BNB smart chain</option>
                                                            <option value="ethereum">ETHEREUM</option>
                                                            <option value="tron">TRON</option>
                                                            <option value="tether">USDT(TRC20)</option>
                                                            <option value="usd-coin">USDT(ERC20)</option>
                                                            <option value="usd-tether">USDT BNB</option>
                                                            <option value="usdc">USDC</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Enter amount in (VALUE)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"  step="any" name="amount_value" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd1">Enter amount in (USD)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" step="any" name="amount_usd" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd2">Wallet Addres</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="wallet" value="" required>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="fundwallet">Fund Users Crypto Balance</button>
                                                </form>
                                            </div>
                                        </div>
                                </div>

                                <section>
                                <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/bitcoin.png" alt="bitcoin" width=55 height=55>
                                            <div>
                                                <h5 class="name">BTC</h5>
                                                <small>$<?php echo number_format($bitcoinPrice); ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5><?php echo $row ['bitcoin_balance'] ?></h5>
                                            <small class="d-flex justify-content-right">
                                                $<?php
                                                $bitcoin_result = $bitcoinPrice * $row['bitcoin_balance'];
                                                echo number_format($bitcoin_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/etheruem.png" alt="etheruem" width=55 height=55>
                                            <div>
                                                <h5 class="name">ETH</h5>
                                                <small>$<?php echo number_format($ethereumPrice); ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['ethereum_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-right">$<?php
                                                $ethereum_result = $ethereumPrice * $row['ethereum_balance'];
                                                echo number_format($ethereum_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/bnb.png" alt="bnb" width=55 height=55>
                                            <div>
                                                <h5>BNB</h5>
                                                <small>$<?php echo number_format($bnbPrice); ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['binancecoin_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-right">
                                                $<?php
                                            $bnb_result = $bnbPrice * $row['binancecoin_balance'];
                                            echo number_format($bnb_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/tron.png" alt="tron" width=55 height=55>
                                            <div>
                                                <h5>TRON</h5>
                                                <small>$<?php echo $trxPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['tron_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-right">
                                                $<?php
                                                $tron_result = $trxPrice * $row['tron_balance'];
                                                echo number_format($tron_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/usdttrc.png" alt="usdt_trc" width=55 height=55>
                                            <div>
                                                <h5 class="namee">USDT</h5>
                                                <small>$<?php echo $tetherPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['tether_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-right">
                                                $<?php
                                                $tether_result = $tetherPrice * $row['tether_balance'];
                                                echo number_format($tether_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/usdterc.png" alt="usdt_erc" width=55 height=55>
                                            <div>
                                                <h5 class="namee">USDT</h5>
                                                <small>$<?php echo $usdCoinPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['usd-coin_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-right">
                                                $<?php
                                                $usd_result = $usdCoinPrice * $row['usd-coin_balance'];
                                                echo number_format($usd_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/usdtbnb.png" alt="usdt_erc" width=50 height=45>
                                            <div>
                                                <h5 class="namee">USDT</h5>
                                                <small>$<?php echo $usdtbnbPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['usd-tether_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                                $usd_result = $usdtbnbPrice * $row['usd-tether_balance'];
                                                echo number_format($usd_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                    <a class="coin" href="javascript:void(0)jm">
                                        <div class="coinimg">
                                            <img src="./img/solona.png" alt="solona" width=45 height=45>
                                            <div>
                                                <h5 class="namee">USDC</h5>
                                                <small>$<?php echo $usdcPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5>
                                            <?php echo $row ['usdc_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                                $usd_result = $usdcPrice * $row['usdc_balance'];
                                                echo number_format($usd_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                </section>
                                <?php }} }?>

                            </div>
                        <!-- </div> -->
                    <!-- </div>
                </div> -->
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
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2020 Coolwallet
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
    
</body>


</html>