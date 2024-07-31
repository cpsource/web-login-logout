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
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Random Color Words with Tooltips</h1>
        <p1>Hover over the word to get the French translation.</p1>
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
                    echo '<span class="colored-word" style="color:' . $color . ';">' . htmlspecialchars($word) . '<span class="tooltip-custom">' . htmlspecialchars($french_word) . '</span></span>';
                }
            ?>
        </div>
    </div>
</body>
</html>

