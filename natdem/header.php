<?php
$cp_border = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .darker-green-bg {
            background-color: #a3d9a5;
            /* Slightly darker green background */
            padding-top: 10px;
            /* Add 10px padding at the top */
            padding-bottom: 10px;
        }

        .img-fluid {
            max-height: 200px;
            /* Adjust the height to match the second image */
            width: auto;
            /* Keep the aspect ratio */
            display: block;
            margin: 0 auto;
            /* Center the image horizontally */
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
            margin: 20px auto;
            /* Add 20px padding around the hr */
        }

        .custom-container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        .custom-container {
            width: 80%; /* Set the container to 75% of the viewport width */
            margin: 0 auto; /* Center the container horizontally */
            display: flex;
            flex-wrap: wrap; /* Allow the columns to wrap on smaller screens */
        }

        .left-column-a {
            flex: 0 0 15%; /* Take up 20% of the container's width */
            max-width: 15%; /* Ensure the column does not exceed 20% */
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
        }

        .right-column-a {
            flex: 1; /* Take up the remaining space */
            background-color: #f8f9fa; /* Light background color */
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
        }
        .left-column-b {
            flex: 0 0 15%; /* Take up 20% of the container's width */
            max-width: 15%; /* Ensure the column does not exceed 20% */
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
        }

        .right-column-b {
            flex: 1; /* Take up the remaining space */
            background-color: #a3d9a5; /* Light background color */
            padding: 20px;
            box-sizing: border-box; /* Ensure padding is included in the width */
	    <?php
	    if ($cp_border) {
		echo "border: 8px solid red;"; /* for debug, show our container */
	    }
            ?>
        }
	.row {
	    <?php
	    if ($cp_border) {
		echo "border: 8px solid blue;"; /* for debug, show our container */
	    }
            ?>
	}
	.black-border {
	    <?php
	    if ($cp_border) {
		echo "border: 8px solid black;"; /* for debug, show our container */
	    }
            ?>
	}
        
    </style>
</head>

<?php
// setup our configuration
include 'config.php';
?>

<body>
<div class="container">
    <div class="left-column-a">
    </div>
    <div class="right-column-b darker-green-bg">
      <div class="row">
	
	<div class="col-md-4 black-border">
          <div class="p-3 border bg-light">
            <!-- Content for the first column -->
	    <img src="rights/author/Bill_Page_In_Uniform.jpg" alt="Bill Page in Uniform" class="img-fluid">
          </div>
	</div>

	<div class="col-md-4 center-content black-border">
          <div class="p-3 border bg-light">
            <!-- Content for the second column -->
	    <h1 class="text-black">Natural Democracy</h1>
	    <p>Natural Democracy by William R. Page</p>
          </div>
	</div>

	<div class="col-md-4 black-border">
	  <div class="p-3 border bg-light">
	    <!-- Content for the third column -->
            <img src="./images/WRPBookCover.jpg" alt="WRP Book Cover" class="img-fluid">
	  </div>
	</div>
      </div>
    </div>
</div>

    <hr class="custom-hr">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="/js/bootstrap.js"></script>
</body>

</html>
