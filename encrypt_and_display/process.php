<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);

    // Check if any field is empty
    if (empty($email) || empty($name) || empty($password)) {
        $error = "Error: All fields are required.";
    } else {
        // Convert data to XML
        $xml = new SimpleXMLElement('<data/>');
        $xml->addChild('email', $email);
        $xml->addChild('name', $name);
        $xmlString = $xml->asXML();

        // Encrypt the XML string
        $method = 'aes-256-cbc';
        $key = hash('sha256', $password, true);
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($xmlString, $method, $key, OPENSSL_RAW_DATA, $iv);

        if ($encrypted === false) {
            $error = "Error: Encryption failed.";
        } else {
            // Combine IV and encrypted data
            $encryptedWithIv = $iv . $encrypted;

            // Convert to hexadecimal
            $hexResult = bin2hex($encryptedWithIv);
        }
    }

    if (isset($error)) {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Error</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">Error</h2>
                <div class="alert alert-danger mt-3" role="alert">
                    <strong>' . $error . '</strong>
                </div>
                <a href="index.php" class="btn btn-primary btn-block">Go Back</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>';
    } else {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Encryption Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">Encryption Result</h2>
                <div class="alert alert-success mt-3" role="alert">
                    <strong>Hexadecimal Result:</strong> <pre>' . $hexResult . '</pre>
                </div>
                <a href="index.php" class="btn btn-primary btn-block">Go Back</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>';
    }
}
?>

