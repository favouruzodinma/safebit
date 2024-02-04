<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../cft-logo2.png" >
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
        <a href="usdt_erc">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        </a>
        <span class="text-light">Receive </span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
    </nav>
    <br>
    <div class="card-body text-warning warning">
        <p>Only send <strong>USDT(ERC)</strong> network assets to this address othe assets will be lost forever.</p>
    </div>
</header>
 <main>
    <br>
    <center>
        <div class="namee">
            <img src="./img/usdterc.png" alt="usdterc" width=35 height=35>
            <h3 class="text-light pt-3">USDT</h3>
            <sup class="bg-dark" style="font-size:12px; background-color:blue"><small class="text-muted">COIN</small></sup> 
        </div>
        <img src="img/usdt-barcode.jpeg" alt="usdterc scan image" width=200 height=200 />
    </center>
    <br>
 </main>
 <section class="history">
  <center>
    <a class="coin card-body" href="javascript:void(0)">
        <div class="coinimg">
            <div>
                <h5 class="text-muted" style="position:relative; left:-8px">Network</h5>
                <h3 style="font-size:18px">USDT ERC(20)</h3>
            </div>
        </div>
        <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrows-expand" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10"/>
        </svg>
        </div>
    </a>
    </center>
    <?php
session_start();
require_once("../_db.php");
$userid = $_SESSION['userid'];

// Function to shorten the wallet address
function shortenWalletAddress($address, $length = 20) {
    return substr($address, 0, $length);
}

// Prepare a statement
$stmt = $conn->prepare("SELECT * FROM user_login WHERE userid = ?");
$stmt->bind_param("s", $userid);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Your data retrieval
        $shortenedusdWallet = shortenWalletAddress($row["usd-coin_wallet"]);
        ?>
        <center>
            <a class="coin card-body" href="javascript:void(0)">
                <div class="coinimg">
                    <div>
                        <h5 class="text-muted" style="position:relative; left:-45px">Receive Address</h5>
                        <input type="hidden" name="usd-coin_wallet" id="walletAddress" value="<?php echo $row["usd-coin_wallet"]; ?>" >
                        <h3 style="font-size:18px" ><?php echo $shortenedusdWallet;?>......</h3>
                    </div>
                </div>
                <div onclick="copyToClipboard('<?php echo $row["usd-coin_wallet"]; ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         class="bi bi-copy" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                    </svg>
                </div>
            </a>
            <script>
                function copyToClipboard(walletAddress) {
                    // Create a temporary input element
                    var tempInput = document.createElement("input");
                    tempInput.setAttribute("value", walletAddress);
                    document.body.appendChild(tempInput);

                    // Select and copy the text
                    tempInput.select();
                    document.execCommand("copy");

                    // Remove the temporary input element
                    document.body.removeChild(tempInput);

                    // Notify the user that the address has been copied
                    alert("Wallet address copied: " + walletAddress);
                }
            </script>
        </center>
        <?php
    }
}
?>
   <br>
   <br>
 </section>
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
</body>
</html>