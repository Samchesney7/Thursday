<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <title>Your Website</title>
    <style>
        .cookie-popup {
            display: <?php echo isset($_COOKIE['cookiesAccepted']) ? 'none' : 'block'; ?>;
            position: fixed;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f1f1f1;
            padding: 80px; 
            border-radius: 15px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            font-size: 18px; 
        }
    </style>
</head>
<body>

<div id="cookie-popup" class="cookie-popup" onclick="this.style.display='none'; acceptCookies();">
    <p>Welcome to my website</p>
    <button>Got it!</button>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: calc(100% - 20px);
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #000000;
            border-radius: 5px;
            background-color: #3498db;
            transition: background-color 0.3s;
            cursor: pointer;
            border: none;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .header {
            text-align: right;
            margin-top: 20px;
            position: fixed;
            top: 0;
            right: 0;
            padding: 10px;
        }

        .header a {
            color: #000000;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-left: 10px;
        }

        .header a:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Database</title>
</head>
<body>

    <div class="container">

        <h1>Call Of Duty Wiki</h1>

        <form action="scriptn.php" method="post">
            <label for="searchName">Enter Call Of Duty game's name:</label>
            <input type="text" name="searchName" required>
            <br>
            <input type="submit" value="Search">
        </form>

    </div>

    <!-- Header with Sign In button -->
    <div class="header">
        <a href="loginPage.html">Sign In / Register</a>
    </div>

    <h2>Create Game Record</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        
        <label for="developer">Developer:</label>
        <input type="text" name="developer" required>

        <label for="date">Release Date:</label>
        <input type="date" name="date" required>

        <label for="age_rating">Age Rating:</label>
        <input type="text" name="age_rating" required>

        <input type="submit" name="create" value="Create Record">
    </form>

    <h2>Update Game Record</h2>
    <form action="" method="post">
        <label for="update_id">Game Name to Update:</label>
        <input type="text" name="update_Game_Name" required>

        <label for="new_name">New Name:</label>
        <input type="text" name="new_name" required>

        <label for="new_developer">New Developer:</label>
        <input type="text" name="new_developer" required>

        <label for="new_date">New Release Date:</label>
        <input type="date" name="new_Release_Date" required>

        <label for="new_age_rating">New Age Rating:</label>
        <input type="text" name="new_age_rating" required>

        <input type="submit" name="update" value="Update Record">
    </form>

    <h2>Delete Game Record</h2>
    <form action="" method="post">
        <label for="delete_Game_Name">Game Name to Delete:</label>
        <input type="text" name="delete_Game_Name" required>

        <input type="submit" name="delete" value="Delete Record">
    </form>

    <?php

    if (isset($_COOKIE['last_action'])) {
        $last_action = $_COOKIE['last_action'];
        echo "<p>Last Action: $last_action</p>";
    }
    ?>

</body>
</html>


<?php


$servername = "localhost";
$db_username = "2219976";
$db_password = "jj9nq4";
$db_name = "db2219976";

try {
    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create Game Record
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $developer = $_POST['developer'];
        $date = $_POST['date'];
        $age_rating = $_POST['age_rating'];

        $insert_query = "INSERT INTO `Call Of Duty Games` (`Game name`, `Developer`, `Release Date`, `Age Rating`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);

        // Bind parameters
        $stmt->bind_param("ssss", $name, $developer, $date, $age_rating);

        // Execute statement
        $stmt->execute();

        echo "<p>Game Record created successfully</p>";

        // Set a cookie for the last action
        $cookie_name = "last_action";
        $cookie_value = "create";
        setcookie($cookie_name, $cookie_value, time() + (800 * 30), "/"); // 800 = 1 day

        // Close statement
        $stmt->close();
    }

    // Update Game Record
    if (isset($_POST['update'])) {
        $update_Game_Name = $_POST['update_Game_Name']; // Updated variable name
        $new_name = $_POST['new_name'];
        $new_developer = $_POST['new_developer'];
        $new_date = $_POST['new_Release_Date']; // Updated field name
        $new_age_rating = $_POST['new_age_rating'];

        $update_query = "UPDATE `Call Of Duty Games` SET `Game name` = ?, `Developer` = ?, `Release Date` = ?, `Age Rating` = ? WHERE `Game name` = ?";
        $stmt = $conn->prepare($update_query);

        // Bind parameters
        $stmt->bind_param("sssss", $new_name, $new_developer, $new_date, $new_age_rating, $update_Game_Name);

        // Execute statement
        $stmt->execute();

        echo "<p>Game Record updated successfully</p>";

        // Set a cookie for the last action
        $cookie_name = "last_action";
        $cookie_value = "update";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

        // Close statement
        $stmt->close();
    }

    // Delete Game Record
    if (isset($_POST['delete']) && isset($_POST['delete_Game_Name'])) {
        $delete_Name = $_POST['delete_Game_Name'];

        $delete_query = "DELETE FROM `Call Of Duty Games` WHERE `Game name` = ?";
        $stmt = $conn->prepare($delete_query);

        // Bind parameters
        $stmt->bind_param("s", $delete_Name);

        // Execute statement
        $stmt->execute();

        echo "<p>Game Record deleted successfully</p>";

        // Set a cookie for the last action
        $cookie_name = "last_action";
        $cookie_value = "delete";

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();

} catch (mysqli_sql_exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>


