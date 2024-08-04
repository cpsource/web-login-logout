<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown to HTML Example</title>
    <!-- Bootstrap 4 CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- font -->
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background for better readability */
            padding: 20px;
        }
        .headline {
            font-family: Cheltenham, serif;
            font-size: 2em; /* Larger font size for headlines */
            font-weight: bold;
            margin-bottom: 10px;
        }
        .article, h2, h3 {
            font-family: Georgia, serif;
            font-size: 1.2em; /* Standard font size for article text */
            line-height: 1.6;
        }
	h2, h3 {
            font-weight: bold;
	}
	
    </style>    
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center headline">Markdown to HTML Example (fonts)</h1>
        <div class="mt-4 article">
            <?php
                require 'Parsedown.php';
                $Parsedown = new Parsedown();

                // Path to the markdown file
                $filePath = 'assets/fonts.md'; // Update with the actual path to fonts.md
                if (file_exists($filePath)) {
                    $markdown = file_get_contents($filePath);
                    // Convert markdown to HTML
                    $html = $Parsedown->text($markdown);
                    // Display the HTML content
                    echo $html;
                } else {
                    echo '<p class="text-danger">File not found.</p>';
                }
            ?>
        </div>
    </div>

    <!-- Bootstrap 4 JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

