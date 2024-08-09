<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .darker-green-bg {
            background-color: #a3d9a5; /* Slightly darker green background */
	    padding-top: 10px; /* Add 10px padding at the top */
            padding-bottom: 10px;
        }
        .img-fluid {
            max-height: 200px; /* Adjust the height to match the second image */
            width: auto; /* Keep the aspect ratio */
            display: block;
            margin: 0 auto; /* Center the image horizontally */
        }
        .no-padding {
            padding: 0;
        }
        .center-content {
            text-align: center;
        }
        hr.custom-hr {
            border: none;
            border-top: 2px solid black;
            width: 50%;
            margin: 20px auto; /* Add 20px padding around the hr */
        }
    </style>
</head>

<?php
// setup our configuration
include 'config.php';
?>

<body>
    <div class="container darker-green-bg">
        <div class="row no-padding">
            <div class="col-md-4 no-padding center-content">
                <img src="rights/author/Bill_Page_In_Uniform.jpg" alt="Bill Page in Uniform" class="img-fluid">
            </div>
            <div class="col-md-4 no-padding center-content">
                <h1 class="text-black">Natural Democracy</h1>
                <p>Natural Democracy by William R. Page</p>
            </div>
            <div class="col-md-4 no-padding center-content">
                <img src="./images/WRPBookCover.jpg" alt="WRP Book Cover" class="img-fluid">
            </div>
        </div>
    </div>

    <hr class="custom-hr">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

