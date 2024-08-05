<?php

// ACK - don't forget to extension=sqlite3 in the apache php.ini file !!!
// ACK ACK - and load the extension thus: sudo apt-get install php-sqlite3
//
//
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap 4 Form with PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mt-3">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <input type="hidden" id="part_number" name="part_number" value="12345">
                    <input type="hidden" id="date_accessed" name="date_accessed" value="<?php echo date('Y-m-d'); ?>">
                    <input type="hidden" id="session_id" name="session_id" value="<?php echo session_id(); ?>">
                    <input type="hidden" id="login_level" name="login_level" value="user">
                    <button type="submit" class="btn btn-success btn-block">Submit</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $part_number = htmlspecialchars($_POST['part_number']);
                    $date_accessed = htmlspecialchars($_POST['date_accessed']);
                    $session_id = htmlspecialchars($_POST['session_id']);
                    $login_level = htmlspecialchars($_POST['login_level']);

                    if ($part_number !== '12345') {
                        echo "<div class='alert alert-danger mt-3' role='alert'>";
                        echo "Error: Invalid part number.";
                        echo "</div>";
                    } elseif (strlen($password) < 8) {
                        echo "<div class='alert alert-danger mt-3' role='alert'>";
                        echo "Error: Password must be at least 8 characters long.";
                        echo "</div>";
                    } else {
                        // Path to the SQLite3 database file
                        $dbPath = '/var/www/data/users.db';
			try {
                          // Open the database
                          $db = new SQLite3($dbPath,SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
			  echo "Database connection successful.";
                        } catch (Exception $e) {
                            	// Handle the exception if the connection fails
				echo "Failed to connect to the database: " . $e->getMessage();
				sleep(5);
                        }
                        // Check if email exists and get the password and login_level
                        $stmt = $db->prepare('SELECT password, login_level FROM users WHERE email_address = :email_address');
                        $stmt->bindValue(':email_address', $email, SQLITE3_TEXT);
                        $result = $stmt->execute();
                        $row = $result->fetchArray(SQLITE3_ASSOC);

                        if (!$row) {
                            echo "<div class='alert alert-danger mt-3' role='alert'>";
                            echo "Error: Email address not found.";
                            echo "</div>";
                        } elseif ($row['password'] !== $password) {
                            echo "<div class='alert alert-danger mt-3' role='alert'>";
                            echo "Error: Incorrect password.";
                            echo "</div>";
                        } else {
                            // Store variables in session
                            $_SESSION['email'] = $email;
                            $_SESSION['login_level'] = $row['login_level'];

                            // Set the cookie
                            setcookie("MyApplication.login_level", $row['login_level'], time() + (86400 * 30), "/"); // 86400 = 1 day

                            // Prepare the INSERT statement
                            $stmt = $db->prepare('INSERT INTO users (date_accessed, session_id, email_address, password, login_level) VALUES (:date_accessed, :session_id, :email_address, :password, :login_level)');
                            $stmt->bindValue(':date_accessed', $date_accessed, SQLITE3_TEXT);
                            $stmt->bindValue(':session_id', $session_id, SQLITE3_TEXT);
                            $stmt->bindValue(':email_address', $email, SQLITE3_TEXT);
                            $stmt->bindValue(':password', $password, SQLITE3_TEXT);
                            $stmt->bindValue(':login_level', $row['login_level'], SQLITE3_TEXT);

                            // Execute the statement and check for errors
                            try {
                                $stmt->execute();
                                echo "<div class='alert alert-success mt-3' role='alert'>";
                                echo "Form submitted successfully!<br>";
                                echo "Email: $email<br>";
                                echo "Password: $password<br>";
                                echo "Date Accessed: $date_accessed<br>";
                                echo "Session ID: $session_id<br>";
                                echo "Login Level: " . $row['login_level'];
                                echo "</div>";
                            } catch (Exception $e) {
                                echo "<div class='alert alert-danger mt-3' role='alert'>";
                                if ($e->getCode() == 23000) { // SQLite constraint violation
                                    echo "Error: The email address is already registered.";
                                } else {
                                    echo "Error: Could not save data. " . $e->getMessage();
                                }
                                echo "</div>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

