<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Color Words with Tooltips</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .colored-word {
            display: inline-block;
            margin-right: 5px;
            font-family: Arial, sans-serif;
            font-size: 18pt;
            cursor: pointer; /* Adds a pointer cursor for better UX */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Random Color Words with Tooltips</h1>
        <div class="mt-4">
            <?php
                $sentence = "The quick brown fox jumped over the lazy dog.";
                $translations = [
                    "The" => "Le",
                    "quick" => "rapide",
                    "brown" => "brun",
                    "fox" => "renard",
                    "jumped" => "sauté",
                    "over" => "par-dessus",
                    "the" => "le",
                    "lazy" => "paresseux",
                    "dog" => "chien"
                ];
                $words = explode(" ", $sentence);

                foreach ($words as $word) {
                    $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    $french_word = isset($translations[$word]) ? $translations[$word] : $word;
                    echo '<span class="colored-word" style="color:' . $color . ';" data-toggle="tooltip" title="' . htmlspecialchars($french_word) . '">' . htmlspecialchars($word) . '</span>';
                }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize Bootstrap tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>

