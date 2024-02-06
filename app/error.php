<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Error Popup</title>
</head>
<body>

<!-- Button to trigger the error popup -->
<button id="showErrorBtn">Click here To See The Error</button>

<!-- Error Popup Container -->
<div id="errorPopup">
    <div class="popup-content">
        <span class="close" id="closeErrorBtn">&times;</span>
        <h2>Error</h2>
        <p>There is a problem trying to connect your wallet.
            <br>
            <br>
            <a href="connect">Back</a>
        </p>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
