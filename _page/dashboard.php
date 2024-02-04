<?php
$url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,ripple,trx,tether,usd-coin,binancecoin,usd-tether,usd-coin&vs_currencies=usd";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="SBT_logo.png" >
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

<body class="skin-default fixed-layout body">

<header>
    <nav class="top">
        <div class="overlay-content">
        <!-- Your menu items go here -->
        <a href="javascript:void(0)" style="position:relative; right:-185px">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle text-danger" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </a>
        <a href="./dashboard">Dashboard</a>
        <a href="profile">Profile</a>
        <a href="#">Notification</a>
        <a href="#">Phrase</a>
        <a href="#">Security</a>
        <a href="#">About</a>
        <a href="../app/_page/connect">WalletConnect</a>

        </div>
        <div class="overlay" id="overlay"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="26" id="menuIcon" height="26" fill="currentColor" class="bi bi-gear-fill text-light" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
        <span class="text-light">Home</span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
    </nav>
    <div class="form-group inputi">
        <input type="search" class="form-control" placeholder="search">
    </div>
</header>
 <main>
    <center>
    <div class="second">
        <?php 
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
        <div class="second1">
        <h5 class="text-light d-flex justify-content-start"><?php echo $row["flname"] ?></h5>
        <h2 class="text-light">
            $<?php
            $bitcoin_result = $bitcoinPrice * $row['bitcoin_balance'];
            $ethereum_result = $ethereumPrice * $row['ethereum_balance'];
            $tron_result =  $trxPrice * $row['tron_balance'];
            $tether_result = $tetherPrice * $row['tether_balance'];
            $usd_result = $usdCoinPrice * $row['usd-coin_balance'];
            $usdtbnb_result = $usdtbnbPrice * $row['usd-tether_balance'];
            $usdc_result = $usdcPrice * $row['usdc_balance'];
            $bnb_result=$bnbPrice * $row['binancecoin_balance'];
            $total_balance = $bitcoin_result + $ethereum_result + $tron_result + $tether_result + $usd_result + $usdtbnb_result + $usdc_result + $bnb_result;
            echo number_format($total_balance);
            ?>
        </h2>
        </div>
        <div class="second2">

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
        </svg>
        </div>
    </div>
    </center>
    <br>
    <center>
        <div class="third">
        <div class="ree">
        <a href="send" title="SEND COIN">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
        </svg>
        </a>
        <small>SEND</small>
        </div>

        <div class="ree">
        <a href="receive" title="RECEIVE COIN">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
        </svg>
        </a>
        <small>RECEIVE</small>
        </div>

        <div class="ree">
        <a href="https://moonpay.com" title="BUY COIN">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z"/>
        </svg>
        </a>
        <small>BUY</small>
        </div>
        </div>
    </center>
    <center>
        <ul class="fourth">
            <li><a href="javascript:void(0)">Crypto</a></li>
            <li><a href="javascript:void(0)">NFTs</a></li>
        </ul>
    </center>
 </main>
 <section>
   <center>
   <a class="coin" href="bitcoin">
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

    <a class="coin" href="etheruem">
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

    <a class="coin" href="bnb">
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

    <a class="coin" href="tron">
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

    <a class="coin" href="usdt_trc">
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

    <a class="coin" href="usdt_erc">
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
            <small class="d-flex justify-content-end">
                $<?php
                $usd_result = $usdCoinPrice * $row['usd-coin_balance'];
                echo number_format($usd_result);
                ?>
            </small>
        </div>
    </a>
    <a class="coin" href="usdtbnb">
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
                $usdtbnb_result = $usdtbnbPrice * $row['usd-tether_balance'];
                echo number_format($usdtbnb_result);
                ?>
            </small>
        </div>
    </a>
    <a class="coin" href="usdc">
        <div class="coinimg">
            <img src="./img/solona.png" alt="usdt_erc" width=45 height=45>
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
                $usdc_result = $usdcPrice * $row['usdc_balance'];
                echo number_format($usdc_result);
                ?>
            </small>
        </div>
    </a>
   </center>
 </section>
 <?php }} ?>

 <footer class="mt-5 sticky">
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
 <script src="script.js"></script>
</body>
</html>