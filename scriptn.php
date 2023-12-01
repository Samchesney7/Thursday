<?php
// Connect to server/database
$mysqli = mysqli_connect("localhost", "2219976", "jj9nq4", "db2219976");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Build custom SQL query
$sql = "SELECT ";

// Check if any field is selected
$selectedFields = isset($_POST['selectedFields']) ? $_POST['selectedFields'] : [];

if (empty($selectedFields)) {
    // Default fields if none are selected
    $sql .= "`Game name`, `Developer`, `Age Rating`, `Release Date`";
} else {
    // Use selected fields
    $sql .= implode(", ", array_map(function ($field) {
        return "`$field`";
    }, $selectedFields));

    // Set a cookie with the selected fields
    setcookie('selectedFields', implode(',', $selectedFields), time() + 3600, '/');
}

$sql .= " FROM `Call Of Duty Games` WHERE 1";


$searchName = isset($_POST['searchName']) ? $_POST['searchName'] : '';
$searchDeveloper = isset($_POST['searchDeveloper']) ? $_POST['searchDeveloper'] : '';
$searchAgeRating = isset($_POST['searchAgeRating']) ? $_POST['searchAgeRating'] : '';
$searchReleaseDate = isset($_POST['searchReleaseDate']) ? $_POST['searchReleaseDate'] : '';

if ($searchName != "") {
    $sql .= " AND `Game name` LIKE '%" . $searchName . "%'";
}

if ($searchDeveloper != "") {
    $sql .= " AND `Developer` LIKE '%" . $searchDeveloper . "%'";
}

if ($searchAgeRating != "") {
    $sql .= " AND `Age Rating` = '" . $searchAgeRating . "'";
}

if ($searchReleaseDate != "") {
    $sql .= " AND `Release Date` = '" . $searchReleaseDate . "'";
}

// Run SQL query
$res = mysqli_query($mysqli, $sql);

$num_call = mysqli_num_rows($res);
?>


  

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call of Duty Wiki Search Results</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .back-button {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #000000;
            border-radius: 5px;
            background-color: #3498db;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>

    <div class="container">

        <?php
        if ($num_call == 0) {
            echo "<p>No Call Of Duty with that name, sorry...</p>";
        } else 
            echo "<p>We found $num_call CoD(s) matching that name...</p>";

            // Function to compare two rows based on the selected category
            function compareRows($row1, $row2, $selectedCategory) {
                switch ($selectedCategory) {
                    case 'developer':
                        // Sort by developer name and then by the selected category
                        $developerComparison = strcmp($row1['Developer'], $row2['Developer']);
                        return ($developerComparison !== 0) ? $developerComparison : 0;
                    case 'ageRating':
                        return $row1['Age Rating'] - $row2['Age Rating'];
                    case 'releaseDate':
                        return strtotime($row1['Release Date']) - strtotime($row2['Release Date']);
                    default:
                        
                        return 0;
                }
            }
            
            // Fetch all rows into an array
            $rows = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $rows[] = $row;
            }
            
            // Get the selected category
            $selectedCategory = isset($_POST["category"]) ? $_POST["category"] : 'none';
            
            // Sort the array based on the selected category
            usort($rows, function ($row1, $row2) use ($selectedCategory) {
                return compareRows($row1, $row2, $selectedCategory);
            });
            
            // HTML document
            ?>
            <!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Your Page Title</title>
               
                <style>
                  
                    .back-button {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                    }
            
                   
                    .back-button a {
                        text-decoration: none;
                    }
            
                    .back-button button {
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                    }
                </style>
            </head>
            
            <body>
                <!-- Back button at the top right -->
                <div class="back-button">
                    <a href="menu.php"><button>Back to Menu</button></a>
                </div>
            
                <!-- Filter by Category dropdown -->
                <form method="post" action="" style="margin-top: 40px;">
                    <label for="category">Filter by Category:</label>
                    <select name="category" id="category">
                        <option value="developer">Developer</option>
                        <option value="ageRating">Age Rating</option>
                        <option value="releaseDate">Release Date</option>
                    </select>
                    <input type="submit" value="Filter">
                </form>
            
                <!-- Display the sorted resultset -->
                <?php foreach ($rows as $row) : ?>
                    <div class="result">
                        <h2><?= $row['Game name'] ?></h2>
                        <p><strong>Developer:</strong> <?= $row['Developer'] ?></p>
                        <p><strong>Age Rating:</strong> <?= $row['Age Rating'] ?></p>
                        <p><strong>Release Date:</strong> <?= $row['Release Date'] ?></p>
                    </div>
                <?php endforeach; ?>
            
                
                
            
            </body>
            
            </html>
            