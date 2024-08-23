<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Number Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="number"] {
            padding: 8px;
            margin-right: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
        }
        .prime-number {
            display: inline-block;
            margin: 5px;
            padding: 8px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Prime Number Calculator</h1>
    <form method="post" action="">
        <label for="num_primes">Enter the number of prime numbers to calculate:</label>
        <input type="number" id="num_primes" name="num_primes" min="1" required>
        <input type="submit" value="Calculate">
    </form>

    <div class="result">
        <?php
        function is_prime($num) {
            if ($num < 2) return false;
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i == 0) return false;
            }
            return true;
        }

        function calculate_primes($n) {
            $primes = [];
            $num = 2; // The first prime number
            while (count($primes) < $n) {
                if (is_prime($num)) {
                    $primes[] = $num;
                }
                $num++;
            }
            return $primes;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $n = intval($_POST['num_primes']);
            if ($n > 0) {
                $primes = calculate_primes($n);
                echo "<h2>First $n Prime Numbers:</h2>";
                foreach ($primes as $prime) {
                    echo "<span class='prime-number'>$prime</span>";
                }
            } else {
                echo "<p>Please enter a valid number.</p>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>

