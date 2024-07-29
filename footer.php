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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    </style>
</head>
<body>
    <footer class="footer-container">
        <div class="container">
            <div class="row footer-row">
                <!-- First Column: Picture and Text -->
                <div class="col-md-4 text-center text-md-left footer-column">
                    <img src="path/to/your/image.jpg" class="img-fluid mb-3" alt="Picture">
                    <p>Some descriptive text about the picture.</p>
                </div>

                <!-- Second Column: Copyright -->
                <div class="col-md-4 text-center my-auto footer-column">
                    <p>Copyright &copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
                </div>

                <!-- Third Column: Button to Home -->
                <div class="col-md-4 text-center text-md-right my-auto footer-column">
                    <a href="index.php" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

