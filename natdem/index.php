<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
	nav ul li a {
            display: block;
            color: white; /* Default text color */
            background-color: #a3d9a5; /* Set background color */
            padding: 5px 5px; /* 40px padding on top, 20px padding on left and right */
            text-decoration: none; /* Remove underlines from links */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
        }

        /* Hover effect */
        nav ul li a:hover {
            background-color: #495057; /* Darker background on hover */
            color: #f8f9fa; /* Light text color on hover */
        }

        .sidebar {
            background-color: #a3d9a5; /* Slightly darker green background */
            padding-top: 20px;
            width: 15%; /* Sidebar takes up 20% of the parent container's width */
	    min-height: 100vh;
            margin-left: 0px;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 15px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .container-fluid {
                flex-direction: column;
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
            }
	    
            .sidebar {
                width: 100%;
		min-height: auto;
                margin-left: 0;
            }
	    
            .sidebar a {
                text-align: center;
            }
        }

        .custom-container {
            width: 80%; /* Set the container to 75% of the viewport width */
            margin: 0 auto; /* Center the container horizontally */
            display: flex;
            flex-wrap: wrap; /* Allow the columns to wrap on smaller screens */
	    <?php
	    if ($cp_debug) {
		echo "border: 8px solid black;"; /* for debug, show our container */
	    }
            ?>
        }

        .left-column {
            flex: 0 0 15%; /* Take up 20% of the container's width */
            max-width: 15%; /* Ensure the column does not exceed 20% */
            background-color: #a3d9a5; /* Slightly darker green background */
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
	    <?php
	    if ($cp_debug) {
		echo "border: 8px solid red;"; /* for debug, show our container */
	    }
	    ?>
        }

        .right-column {
            flex: 1; /* Take up the remaining space */
            background-color: #f8f9fa; /* Light background color */
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
	    <?php
	    if ($cp_debug) {
		echo "border: 8px solid blue;"; /* for debug, show our container */
	    }
	    ?>
<!--
	nav a {
            display: block;
            color: white; /* White text color */
            text-align: left; /* Align text to the left */
            padding: 20px 20px; /* Padding around each link (adjust top/bottom for vertical spacing) */
            text-decoration: none; /* Remove underlines from links */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
        }

        /* Hover effect */
        nav a:hover {
            background-color: #495057;
            color: #f8f9fa;
        }
-->
	
    </style>
</head>
<body>

<!-- Include Header -->
<?php include 'header.php'; ?>

<div class="custom-container">
    <div class="left-column">
      <nav class="mt-1">
        <h3 class="text-center text-light">Menu</h3>
	<ul>
          <li><a href="/?page=author">The Author</a></li>
          <li><a href="/?page=book">The Book</a></li>
          <li><a href="/?page=pressroom">Press Room</a></li>
          <li><a href="/?page=udohr">Human Rights</a></li>
          <li><a href="/?page=greatgoals">Great Goals</a></li>
          <li><a href="/?page=fullpotential">Humanity Reaching Full Potential</a></li>
          <li><a href="/?page=family-pictures">Family Pictures</a></li>
          <li><a href="/?page=obituary">Obituary</a></li>
          <li><a href="/?page=bombs">Atomic Bombs</a></li>
          <li><a href="/?page=secretariat">UN Secretariat</a></li>
          <li><a href="/?page=end9">Music and Parting Words</a></li>
	</ul>
      </nav>
    </div>
    <div class="right-column">
        <?php include 'rights/index.php'; ?>
    </div>
</div>

<!-- Include Footer -->
<?php include 'footer.php'; ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>

