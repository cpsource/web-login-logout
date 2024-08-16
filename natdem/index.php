<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
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
        }
    </style>
</head>
<body>

<!-- Include Header -->
<?php include 'header.php'; ?>

<div class="container">
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

