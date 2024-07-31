<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown to HTML Example</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Markdown to HTML Example</h1>
        <div class="mt-4">
            <?php
                require 'Parsedown.php';
                $Parsedown = new Parsedown();

                // Path to the markdown file
                $filePath = 'assets/tst.txt'; // Update with the actual path to tst.txt
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

