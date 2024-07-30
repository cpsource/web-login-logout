<?php
/*
 * Usage:
 
 * Include this footer in your main web pages using PHP's `include` or `require` statement.
 * Example:
 * <?php include 'footer.php'; ?>
 * 
 * Ensure Image Path:
 * Make sure to adjust the image path in the <img> tag to the correct path of your image.
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap-4.4.1.css">
    <style>
        .footer-container {
            background-color: #e9ecef; /* Slightly darker gray background */
            color: #000; /* Black text */
            padding-top: 20px; /* Padding to separate content from the border */
            padding-left: 1in; /* 1 inch padding on the left */
            padding-right: 1in; /* 1 inch padding on the right */
        }
        .footer-row {
            display: flex;
        }
        .footer-column {
            flex: 1; /* Make all columns the same width */
            padding: 10px;
            box-sizing: border-box; /* Ensure padding is included in the element's total width and height */
        }
	       .container {
            text-align: center;
            margin-top: 50px;
        }
        .tagline {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <footer class="footer-container">
        <div class="container">
            <div class="row footer-row">
                <!-- First Column: Picture and Text, a shout-out for https://dummyimage.com -->
                <div class="col-md-4 text-center text-md-left footer-column">
                    <img src="sqrbut.png" class="img-fluid mb-3" alt="Medium Rectangle">
		    <div class="tagline">We Webize to save money and time.</div>
                </div>

                <!-- Second Column: Copyright -->
                <div class="col-md-4 text-center my-auto footer-column">
                    <p>Copyright &copy; <?php echo date("Y"); ?> Webize.com. All rights reserved.</p>
                </div>

                <!-- Third Column: Button to Home -->
                <div class="col-md-4 text-center text-md-right my-auto footer-column">
                    <a href="index.php" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.4.1.js"></script>
</body>
</html>

