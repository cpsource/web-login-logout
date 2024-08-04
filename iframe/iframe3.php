<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to External Web Page</title>
    <script>
        // This script will redirect to the specified URL after a 5-second delay
        window.onload = function() {
            setTimeout(function() {
                window.location.href = "https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/The_box_model";
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    </script>
</head>
<body>
    <p>You will be redirected to the MDN page on the box model in 5 seconds. If not, follow this <a href="https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/The_box_model">link to the MDN page on the box model</a>.</p>
</body>
</html>

