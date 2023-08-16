<?php
require('api.php');
session_start();

// Check if user is logged in

// Handle khoj logic
$searchValueFound = null;

if(isset($_POST['submit'])) {
    $inputValuesStr = $_POST['input_values'];
    $searchValue = $_POST['search_value'];

    // Split the comma-separated input values into an array
    $inputValuesArray = explode(',', $inputValuesStr);
    
    // Trim each value to remove any leading/trailing spaces
    $inputValuesArray = array_map('trim', $inputValuesArray);

    // Sort the input values in descending order
    rsort($inputValuesArray);

    // Store the sorted input values in the database
    // You need to implement this part using appropriate SQL queries

    // Check if the search value exists in the input values
    $searchValueFound = in_array($searchValue, $inputValuesArray);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoj the Search Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Khoj the Search Page</h1>
        <form method="POST" action="khoj.php">
            <input type="text" name="input_values" placeholder="Input Values (comma-separated)" required>
            <input type="text" name="search_value" placeholder="Search Value" required>
            <button type="submit">Khoj</button>
        </form>
        <?php if ($searchValueFound !== null) : ?>
            <p>Output: <?php echo $searchValueFound ? 'True' : 'False'; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
