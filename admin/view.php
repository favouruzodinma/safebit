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


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">View User</h1>
                    </div>
                    <?php 
                    if (isset($_GET['userid'])) {
                        require_once("../_db.php");
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
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">TOPUP USER BALANCE</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>


                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>


                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                <div class="row">
                                        <div class="card-body col-md-6">
                                        <div class="card-body text-primary">
                                            <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle" width="150" style="border-radius: 100px;"/>
                                                <h4 class="card-title m-t-10"><?php  echo $row ['flname']?></h4>
                                                <small class="col-md-10"> <?php if($row['status']=='active'){?>
                                                <a href= "view?id=<?php echo
                                                $row['userid']; ?>&status=ban " class="btn btn-primary btn-sm my-2">Disable User</a>
                                                <?php }else{ ?>
                                                <a href="view?id=<?php echo
                                                $row['userid']; ?>&status=active " class="btn btn-warning btn-sm ">Enable user</a>
                                                <?php } ?></small>
                                            </center>
                                        </div>
                                        <div>
                                            <hr> </div>
                                        <div class="card-body text-primary"> <small class="text-muted">Email address </small>
                                            <h6><?php  echo $row ['email']?></h6> <small class="text-muted p-t-30 db">User ID</small>
                                            <h6><?php  echo $row ['userid']?></h6> <small class="text-muted p-t-30 db">IP Address</small>
                                            <h6><?php  echo $row ['ip_address']?></h6>
                                        </div>
                                        </div>
                                        <div class="card-body col-md-6">
                                        
                                        <form method="POST" action="fund">
                                        <p>KYC verification for all users. kindly process ID before you aprove verification</p>
                                        <h4>SEND TO ALL WALLET</h4>	
                                        <div class="form-group row">
                                            <label for="network" class="col-sm-12 col-form-label">Network</label>
                                            <div class="col-sm-12">
                                            <input type="hidden" value="<?php  echo $userid?>" name="userid">
                                            <input type="hidden" value="<?php  echo $row ['email']?>" name="email">
                                            <input type="hidden" value="<?php  echo $row ['flname']?>" name="flname">
                                            <!-- <input type="text" class="form-control" id="fullname"  value=""> -->
                                            <select name="coin_name" id="" class="form-control">
												<option value="bitcoin">BITCOIN</option>
												<option value="binancecoin">BNB SMART CHAIN</option>
												<option value="ethereum">ETHEREUM</option>
												<option value="tron">TRON</option>
												<option value="tether">USDT(TRC20)</option>
												<option value="usd-coin">USDT(ERC20)</option>
												<option value="usd-tether">USDT(BNB)</option>
												<option value="usdc">USDC</option>
											</select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="value" class="col-sm-12 col-form-label">Enter amount in (VALUE)</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" id="" step="any" name="amount_value" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="usd" class="col-sm-12 col-form-label">Enter amount in (USD)</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" id="" step="any" name="amount_usd" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="wallet" class="col-sm-12 col-form-label">Wallet Addres</label>
                                            <div class="col-sm-12">
                                            <input type="text" class="form-control" id="" name="wallet" value="" required>
                                            </div>
                                        </div>
                                        <input class="btn btn-dark w-100" type="submit" value="Continue" name="fundwallet">
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">USER WALLET BALANCE</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample">
                                <div class="card-body">
                                <section>
                                <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/bitcoin.png" alt="bitcoin" width=48 height=48>
                                            <div>
                                                <h5 style="font-size:13px" class="d-flex justify-content-start">BTC</h5>
                                                <small class="d-flex justify-content-start">$<?php echo number_format($bitcoinPrice); ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;"><?php echo $row ['bitcoin_balance'] ?></h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                                 $bitcoin_result = $bitcoinPrice * $row['bitcoin_balance'];
                                                 echo number_format($bitcoin_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/etheruem.png" alt="etheruem" width=48 height=48>
                                            <div>
                                                <h5 class="d-flex justify-content-start" style="font-size: 13px;">ETH</h5>
                                                <small class="d-flex justify-content-start">$<?php echo number_format($ethereumPrice); ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;">
                                            <?php echo $row ['ethereum_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">$<?php
                                                 $ethereum_result = $ethereumPrice * $row['ethereum_balance'];
                                                 echo number_format($ethereum_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/bnb.png" alt="bnb" width=48 height=48>
                                            <div>
                                                <h5 class="d-flex justify-content-start" style="font-size: 13px;">BNB</h5>
                                                <small class="d-flex justify-content-start">$<?php echo number_format($bnbPrice); ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;">
                                            <?php echo $row ['binancecoin_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                             $bnb_result = $bnbPrice * $row['binancecoin_balance'];
                                             echo number_format($bnb_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/tron.png" alt="tron" width=48 height=48>
                                            <div>
                                                <h5 class="d-flex justify-content-start" style="font-size: 13px;">TRON</h5>
                                                <small class="d-flex justify-content-start">$<?php echo $trxPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;">
                                            <?php echo $row ['tron_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                                 $tron_result = $trxPrice * $row['tron_balance'];
                                                 echo number_format($tron_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/usdttrc.png" alt="usdt_trc" width=48 height=48>
                                            <div>
                                                <h5 class="namee d-flex justify-content-start">USDT</h5>
                                                <small class="d-flex justify-content-start">$<?php echo $tetherPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;">
                                            <?php echo $row ['tether_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                                 $tether_result = $tetherPrice * $row['tether_balance'];
                                                 echo number_format($tether_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>

                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/usdterc.png" alt="usdt_erc" width=48 height=48>
                                            <div>
                                                <h5 class="namee d-flex justify-content-start">USDT</h5>
                                                <small class="d-flex justify-content-start">$<?php echo $usdCoinPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;">
                                            <?php echo $row ['usd-coin_balance'] ?>
                                            </h5>
                                            <small class="d-flex justify-content-end">
                                                $<?php
                                                 $usd_result = $usdCoinPrice * $row['usd-coin_balance'];
                                                 echo number_format($usd_result);
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                    <a class="coin" href="javascript:void(0)">
                                        <div class="coinimg">
                                            <img src="./img/usdtbnb.png" alt="usdt_erc" width=47 height=43>
                                            <div>
                                                <h5 class="namee d-flex justify-content-start">USDT</h5>
                                                <small class="d-flex justify-content-start">$<?php echo $usdtbnbPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 style="font-size: 15px;" class="d-flex justify-content-end">
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
                                            <img src="./img/solona.png" alt="solona" width=42 height=42>
                                            <div>
                                                <h5 class="namee d-flex justify-content-start">USDC</h5>
                                                <small class="d-flex justify-content-start">$<?php echo $usdcPrice; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="d-flex justify-content-end" style="font-size: 15px;">
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

                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }} }?>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- start of Main Content -->
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