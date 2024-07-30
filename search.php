<!DOCTYPE html>

<?php
/* Note from the mother ship:
 Ensure the Search Index is Up-to-Date
 Make sure your search-index.json file is updated whenever you add new pages or modify titles. If your website is dynamically generated, you might need to automate the generation of this index file.

Optional: Back-end Search Solutions
For larger websites or more advanced search functionalities, consider using a back-end search engine like Elasticsearch, Algolia, or a custom server-side solution. These services provide powerful indexing and searching capabilities but require additional setup and integration.
 */
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website with Search</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Search the Site</h2>
        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
        <ul class="list-group mt-3" id="searchResults"></ul>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Fetch the search index
            $.getJSON('search-index.json', function(data) {
                var searchIndex = data;
                // Search functionality
                $("#searchInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    var results = searchIndex.filter(function(item) {
                        return item.title.toLowerCase().includes(value);
                    });
                    displayResults(results);
                });

                function displayResults(results) {
                    var searchResults = $("#searchResults");
                    searchResults.empty();
                    if (results.length > 0) {
                        results.forEach(function(result) {
                            searchResults.append('<li class="list-group-item"><a href="' + result.url + '">' + result.title + '</a></li>');
                        });
                    } else {
                        searchResults.append('<li class="list-group-item">No results found</li>');
                    }
                }
            });
        });
    </script>
</body>
</html>

