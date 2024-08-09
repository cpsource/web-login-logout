<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .darker-green-bg {
            background-color: #a3d9a5; /* Slightly darker green background */
            padding-top: 10px; /* Add 10px padding at the top */
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
            border-top: 3px solid black;
            width: 70%;
            margin: 20px auto; /* Center the hr and add padding */
        }
        .limited-width-text {
            max-width: 70%;
            margin: 0 auto;
        }
        hr.light-hr {
            border: none;
            border-top: 1px solid #ccc; /* Light grey border */
            margin: 5px 0;
        }

        /* Custom CSS for the sidebar */
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #a3d9a5; /* Slightly darker green background */
            padding-top: 20px;
	    min-height: 100vh;
            margin-left: 30px; /* Move the sidebar 30px to the right */
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 15px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #f8f9fa;
        }

        .content {
            padding: 20px;
            background-color: #f8f9fa;
            flex: 1;
        }

        @media (max-width: 768px) {
            .sidebar {
                min-width: 100%;
                max-width: 100%;
                min-height: auto;
            }

            .sidebar a {
                text-align: center;
            }

            .content {
                padding-top: 20px;
            }
        }
	
    </style>
</head>
<body>

    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
      <div class="row">
	<!-- Sidebar -->

            <nav class="col-md-3 col-lg-2 sidebar">
                <h3 class="text-center text-light">Menu</h3>
                <a href="/?page=author">The Author</a>
                <a href="/?page=book">The Book</a>
                <a href="/?page=pressroom">Press Room</a>
                <a href="/?page=udohr">Human Rights</a>
		<a href="/?page=greatgoals">Great Goals</a>
		<a href="/?page=fullpotential">Humanity Reaching Full Potential</a>
		<a href="/?page=family-pictures">Family Pictures</a>
		<a href="/?page=obituary">Obituary</a>
		<a href="/?page=bombs">Atomic Bombs</a>
		<a href="/?page=secretariat">UN Secretariat</a>
		<a href="/?page=end9">Music and Parting Words</a>						
            </nav>

	<!-- Main content -->

	    <main class="col-md-8 col-lg-8 content">
<?php
include 'rights/index.php';
?>
            </main>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

