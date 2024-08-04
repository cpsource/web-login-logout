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
