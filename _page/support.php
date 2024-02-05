<?php
session_start();
$userid = $_SESSION['userid'] ?? null;
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
<style>
    .whatsapp-icon {
    position: fixed;
    bottom: 50px; /* Adjust the distance from the bottom as needed */
    left: 20px; /* Adjust the distance from the left as needed */
    z-index: 9999;
    }
    /* img{
    background: url('whatsapp-icon.png');
    } */
    .whatsapp-icon svg {
    width: 60px; /* Adjust the size of the icon as needed */
    height: auto;
    border-radius: 50%; /* Make the icon circular */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Add a shadow effect */
    }

</style>
<body class="skin-default fixed-layout body h-100">
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
        <a href="support">Support</a>
        <a href="../app/_page/connect">WalletConnect</a>

        </div>
        <div class="overlay" id="overlay">close</div>
        <svg xmlns="http://www.w3.org/2000/svg" width="26" id="menuIcon" height="26" fill="currentColor" class="bi bi-gear-fill text-light" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
        <span class="text-light" style="font-size: 20px;">HELP CENTER </span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
</nav>
<main style="height:75vh; position:relative; bottom:-140px">
    <center>
        <p class="text-light">
            <span id="time"></span>. How can we help?
        </p>
        <p class="text-warning">Chat our Support Team through Whatsapp or By clicking on the Support icon...</p>
    </center>

    <div class="whatsapp-icon">
        <a href="https://wa.me/+77753797584" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="currentColor" class="bi bi-whatsapp text-success" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.920l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.050-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.100-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.050-.099-.445-1.076-.612-1.47-.160-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
            </svg>
        </a>
    </div>

    <script>
        function getGreeting() {
            const currentTime = new Date().getHours();

            if (currentTime >= 5 && currentTime < 12) {
                return "Good Morning";
            } else if (currentTime >= 12 && currentTime < 18) {
                return "Good Afternoon";
            } else {
                return "Good Evening";
            }
        }

        const greeting = getGreeting();
        document.getElementById('time').innerHTML = greeting;
    </script>
    <script src="//code.tidio.co/vavvgcla8rq3lhpzomp3j5pnqtu482tu.js" async></script>
</main>

 <script src="script.js"></script>
</body>
</html>