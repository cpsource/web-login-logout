<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Color Words with Tooltips</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .colored-word {
            display: inline-block;
            margin-right: 5px;
            font-family: Arial, sans-serif;
            font-size: 18pt;
            position: relative;
            cursor: pointer; /* Adds a pointer cursor for better UX */
        }
        .tooltip-custom {
            display: none;
            position: absolute;
            background: #000;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12pt;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }
        .colored-word:hover .tooltip-custom {
            display: block;
        }
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="center-container">
        <div class="container text-center mt-5">
            <h1 class="text-center">Random Color Words with Tooltips</h1>
            <p>Hover over the word to get the French translation.</p>
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
                        echo '<span class="colored-word" style="color:' . $color . ';" data-bs-toggle="tooltip" title="' . htmlspecialchars($french_word) . '">' . htmlspecialchars($word) . '<span class="tooltip-custom">' . htmlspecialchars($french_word) . '</span></span>';
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>

