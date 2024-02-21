
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
    <link rel="icon" type="image/png" sizes="16x16" href="../../cft-logo2.png" >
    <title>Cool Wallet</title>
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
        <a href="phrase">Phrase</a>
        <a href="security">Security</a>
        <a href="support">Support</a>
        <a href="../app/connect">WalletConnect</a>

        </div>
        <div class="overlay" id="overlay"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="26" id="menuIcon" height="26" fill="currentColor" class="bi bi-gear-fill text-light" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
        <span class="text-light">RECEIVE</span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
    </nav>
</header>
 <section>
 <?php
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
        $shortenedbitcoinWallet = shortenWalletAddress($row["bitcoin_wallet"]);
        $shortenedethWallet = shortenWalletAddress($row["ethereum_wallet"]);
        $shortenedbinancecoinWallet = shortenWalletAddress($row["binancecoin_wallet"]);
        $shortenedtronWallet = shortenWalletAddress($row["tron_wallet"]);
        $shortenedtetherWallet = shortenWalletAddress($row["tether_wallet"]);
        $shortenedusdWallet = shortenWalletAddress($row["usd-coin_wallet"]);
        $shortenedusdcWallet = shortenWalletAddress($row["usdc_wallet"]);
        $shortenedusdtetherWallet = shortenWalletAddress($row["usd-tether_wallet"]);
        ?>
   <center>
   <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/bitcoin.png" alt="bitcoin" width=55 height=55>
            <div>
                <h5 style="position:relative; left:-73px">BTC</h5>
                <input type="hidden" name="bitcoin_wallet" id="walletAddress" value="<?php echo $row["bitcoin_wallet"]; ?>" >
                <small>
                <?php echo $shortenedbitcoinWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["bitcoin_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/etheruem.png" alt="etheruem" width=55 height=55>
            <div>
                <h5 style="position:relative; left:-75px">ETH</h5>
                <input type="hidden" name="ethereum_wallet" id="walletAddress" value="<?php echo $row["ethereum_wallet"]; ?>" >
                <small>
                <?php echo $shortenedethWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["ethereum_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/bnb.png" alt="bnb" width=55 height=55>
            <div>
                <h5 style="position:relative; left:-75px">BNB</h5>
                <input type="hidden" name="binancecoin_wallet" id="walletAddress" value="<?php echo $row["binancecoin_wallet"]; ?>" >
                <small>
                <?php echo $shortenedbinancecoinWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["binancecoin_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/tron.png" alt="tron" width=55 height=55>
            <div>
                <h5 style="position:relative; left:-70px">TRON</h5>
                <input type="hidden" name="tron_wallet" id="walletAddress" value="<?php echo $row["tron_wallet"]; ?>" >
                <small>
                <?php echo $shortenedtronWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["tron_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/usdttrc.png" alt="usdt_trc" width=55 height=55>
            <div>
                <h5 style="position:relative; left:-40px">USDT TRC(20)</h5>
                <input type="hidden" name="tether_wallet" id="walletAddress" value="<?php echo $row["tether_wallet"]; ?>" >
                <small>
                <?php echo $shortenedtetherWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["tether_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/usdterc.png" alt="usdt_erc" width=55 height=55>
            <div>
                <h5 style="position:relative; left:-40px">USDT ERC(20)</h5>
                <input type="hidden" name="usd-coin_wallet" id="walletAddress" value="<?php echo $row["usd-coin_wallet"]; ?>" >
                <small>
                <?php echo $shortenedusdWallet;?>......
                </small>
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

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/solona.png" alt="usdt_erc" width=45 height=45>
            <div>
                <h5 style="position:relative; left:-60px">USDC</h5>
                <input type="hidden" name="usdc_wallet" id="walletAddress" value="<?php echo $row["usdc_wallet"]; ?>" >
                <small>
                <?php echo $shortenedusdWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["usdc_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>

    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <img src="./img/usdtbnb.png" alt="usdt_erc" width=50 height=40>
            <div>
                <h5 style="position:relative; left:-50px">USDT BNB</h5>
                <input type="hidden" name="usd-tether_wallet" id="walletAddress" value="<?php echo $row["usd-tether_wallet"]; ?>" >
                <small>
                <?php echo $shortenedusdWallet;?>......
                </small>
            </div>
        </div>
        <div onclick="copyToClipboard('<?php echo $row["usd-tether_wallet"]; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-copy" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
        </svg>
        </div>
    </a>
   </center>
   <?php }} ?>
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
 <script src="script.js"></script>
</body>
</html>