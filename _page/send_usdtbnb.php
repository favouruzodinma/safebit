
<?php
session_start();
$url = "https://api.coingecko.com/api/v3/simple/price?ids=usd-tether&vs_currencies=usd";
$get = file_get_contents($url);
$prices = json_decode($get, true);

$defaultPrices = [
    'usd-tether' => 1,  // Replace with a default price for Binance Coin (BNB)
];

// Assign prices or use default values if API fails
$usdtbnbPrice = $prices['usd-tether']['usd'] ?? $defaultPrices['usd-tether'];
$userid = $_SESSION['userid'] ?? null;
$email = $_SESSION['email'] ?? null;
?>
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

<body class="skin-default fixed-layout body h-100">
<header style="height:10vh">
    <nav class="top">
        <a href="usdtbnb">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        </a>
        <span class="text-light">SEND USDT(BNB)</span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
    </nav>
    <br>
</header>
 <main style="height:75vh">
<center>
<?php 
if (isset($_GET['status'])) {
require_once("../_db.php");
$coin_name = $_GET['status'];

// Prepare a statement to fetch coin     details by status
$stmt = $conn->prepare("SELECT * FROM coin WHERE coin_name = ?");
$stmt->bind_param("s", $coin_name);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Your data retrieval

?>
<?php
// send_coin.php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../_db.php");

    $coinType = $_POST['coin_name'];
    $amount = $_POST['amount'];
    $wallet = $_POST['wallet'];
    $userid = $_POST['userid']; // Assuming you have the user's ID sent from the form
    $email = $_POST['email'];

    // Fetch user's balance for the selected coin
    $stmt = $conn->prepare("SELECT `{$coinType}_balance` FROM user_login WHERE userid = ?");
    if ($stmt) {
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $stmt->bind_result($userCoinBalance);
        $stmt->fetch();
        $stmt->close();

        if ($amount <= $userCoinBalance) {
            // Process the transaction, deduct from user's balance, etc.
            // Your transaction handling code here...
              // Insert into sent_history table
              $insertQuery = "INSERT INTO user_history (userid,email, amount, coinType, wallet, sent_at) VALUES (?,?, ?, ?, ?, NOW())";
              $stmtInsert = $conn->prepare($insertQuery);
  
              if ($stmtInsert) {
                  $stmtInsert->bind_param("ssdss", $userid,$email, $amount, $coinType, $wallet);
                  $stmtInsert->execute();
                  $stmtInsert->close();
              } else {
                  // Handle prepare statement error for sent_history insertion
                  $error = "<div class='alert alert-danger d-flex justify-space-between w-100' role='alert'>
                              <strong>Error inserting into user history table</strong> 
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                              </button>
                          </div>";
              }
  
            $error = "<div class='alert alert-warning d-flex justify-space-between w-100' role='alert'>
                        <strong>If You keep seeing this Message Contact support!</strong> 
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            // Additional processing...

        } else {
            // Insufficient balance, show warning
            $error = "<div class='alert alert-danger d-flex justify-space-between w-100' role='alert'>
                        <strong>Insufficient Balance</strong> 
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
    } else {
        // Handle prepare statement error
        $error = "<div class='alert alert-danger d-flex justify-space-between w-100' role='alert'>
                    <strong>Database error</strong> 
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
    }
}
?>
<form class="send card-body" method="POST" action="#" id="cryptoForm" style="height:100%;">
    <?php if (!empty($error)) : ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
    <input type="hidden" name="coin_name" value="<?php echo $coin_name; ?>">
    <input type="hidden" id="coinSelect" name="network" value="usd-tether">
    <input type="text" name="wallet" class="form-control w-100" placeholder="Wallet Address" required>
    <input type="number" name="amount" class="form-control w-100" placeholder="USD AMOUNT" required id="amountInput" step="any" title="Currency" pattern="^\d+(?:\.\d{1,2})?$">
    <span class="input-group-btn">
        <p id="result" style="color:green"></p>
        <p id="usd" style="color:red"></p>
    </span>
    <button class="btn btn-success" name="send_bnb">SEND </button>
</form>

<script>
        // Function to calculate price as you type
    function calculatePrice() {
        const coinSelect = document.getElementById('coinSelect');
        const selectedCoin = coinSelect.value;
        const amount = document.getElementById('amountInput').value;

        // API endpoint to get the current price of a selected coin in USD
        const apiUrl = `https://api.coingecko.com/api/v3/simple/price?ids=${selectedCoin}&vs_currencies=usd`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const price = data[selectedCoin].usd;
                const result = parseFloat(amount) * parseFloat(price);
                document.getElementById('result').innerHTML = `Amount in USD: $${result.toFixed(2)}`;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('result').innerHTML = 'Error fetching data';
            });
    }

    // Event listener for input changes
    document.getElementById('amountInput').addEventListener('input', calculatePrice);

</script>
<?php }}}?>


</center>
 </main>

 <footer class="sticky" style="height:15vh">
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